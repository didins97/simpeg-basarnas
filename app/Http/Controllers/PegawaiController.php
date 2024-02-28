<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\DokumenPegawai;
use App\Models\Pegawai;


class PegawaiController extends Controller
{
    public function index() {
        $pegawai = Pegawai::orderBy('created_at', 'desc')->get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function show($id) {
        $pegawai = Pegawai::with('riwayatJabatan', 'riwayatMutasi')->where('id', $id)->first();
        return view('admin.pegawai.detail', compact('pegawai'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|string',
            't_lahir' => 'required|string',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required',
            'agama' => 'string',
            'status_maritai' => 'required',
            'foto' => 'required',
        ]);

        \DB::beginTransaction();

        try {
            // create pegawai
            $pegawaiData = $request->except('file', 'jenis_file', 'judul_file');
            $pegawaiData['foto'] = $request->hasFile('foto') ? upload_file('public/foto', $request->file('foto'), $request->nip) : 'default.jpg';
            $pegawaiData['sk_pns'] = $request->hasFile('sk_pns') ? upload_file('public/sk_pns', $request->file('sk_pns'), $request->nip) : null;
            $pegawai = Pegawai::create($pegawaiData);

            // upload dokumen
            if ($request->has('file')) {
                $file = $request->file;
                $jenis_file = $request->jenis_file;
                $judul_file = $request->judul_file;

                for($i = 0; $i < count($file); $i++) {
                    $filename = upload_file('public/dokumen', $file[$i], $request->nip, $request->judul_file[$i]);

                    $pegawai->dokumen()->create([
                        'lokasi_file' => $filename,
                        'jenis_dokumen' => $jenis_file[$i],
                        'nama_dokumen' => $judul_file[$i],
                        'tanggal_upload' => Carbon::now(),
                    ]);
                }
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
            dd($e);
        }

        toast('Data pegawai berhasil ditambahkan', 'success');
        return redirect()->route('admin.pegawai.index');
    }

    public function edit($id) {
        $pegawai = Pegawai::where('id', $id)->first();
        return response()->json($pegawai);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string',
            't_lahir' => 'required|string',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required',
            'agama' => 'string',
            'status_maritai' => 'required'
        ]);

        $pegawai = Pegawai::where('id', $id)->first();

        $pegawaiData = $request->all();

        if ($request->has('foto')) {
            $pegawaiData['foto'] = upload_file('public/foto', $request->file('foto'), $request->nip);
        }

        if ($request->has('sk_pns')) {
            $pegawaiData['sk_pns'] = upload_file('public/sk_pns', $request->file('sk_pns'), $request->nip);
        }

        $pegawai->update($pegawaiData);

        toast('Data pegawai berhasil diubah', 'success');
        return redirect()->route('admin.pegawai.index');
    }

    public function destroy($id) {
        $pegawai = Pegawai::where('id', $id)->first();
        $pegawai->delete();

        if ($pegawai->dokumen) {
            foreach ($pegawai->dokumen as $dokumen) {
                Storage::delete('public/dokumen/' . $dokumen->lokasi_file);
                $dokumen->delete();
            }
        }

        if ($pegawai->foto !== 'default.jpg') {
            Storage::delete('public/foto/' . $pegawai->foto);
        }

        return response()->json([
            'message' => 'Pegawai deleted successfully',
            'success' => true
        ]);
    }

    public function uploadDocPendidikan(Request $request, $id) {
        $pegawai = Pegawai::where('id', $id)->first();

        if ($request->hasFile('file')) {
            $newFilename = upload_file('public/dokumen', $request->file('file'), $request->nip, $request->nama_dokumen);
            $pegawai->dokumen()->create([
                'nama_dokumen' => $request->nama_dokumen,
                'jenis_dokumen' => $request->jenis_dokumen,
                'lokasi_file' => $newFilename,
                'tanggal_upload' => Carbon::now(),
            ]);

            toast('Dokumen pendidikan '.$request->nama_dokumen.' telah ditambahkan', 'success');
            return redirect()->route('admin.pegawai.show', $id);
        }
    }

    public function deleteFile($id) {
        $dokumen = DokumenPegawai::where('id', $id)->first();
        $dokumen->delete();

        Storage::delete('public/dokumen/'.$dokumen->lokasi_file);

        return response()->json([
            'message' => 'Dokumen deleted successfully',
            'success' => true
        ]);
    }
}
