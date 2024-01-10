<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Storage;

class MutasiController extends Controller
{
    public function index()
    {
        $pegawaiList = Pegawai::latest()->get();
        $mutasiList = Mutasi::latest()->get();

        return view('admin.mutasi.index', compact('pegawaiList', 'mutasiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tgl_mutasi' => 'required',
            'unit_kerja_sebelum' => 'required|string',
            'unit_kerja_baru' => 'required|string',
            'file_sk' => 'required',
        ]);

        $data = $request->all();
        $data['file_sk'] = upload_file('public/dokumen', $request->file('file_sk'), $request->pegawai_id);

        Mutasi::create($data);

        toast('Data mutasi pegawai berhasil ditambahkan', 'success');
        return redirect()->route('admin.mutasi.index');
    }

    public function edit($id)
    {
        $mutasi = Mutasi::with('pegawai')->find($id);
        return response()->json($mutasi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tgl_mutasi' => 'required',
            'unit_kerja_sebelum' => 'required|string',
            'unit_kerja_baru' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_sk')) {
            $filename = $request->pegawai_id.'_'.'sk_mutasi'.'_'.$request->file_sk->getClientOriginalName();
            $filePath = Storage::putFileAs('public/dokumen', $request->file('file_sk'), $filename);
            $data['file_sk'] = $filename;

            Storage::delete('public/dokumen/' . $jabatan->file_sk);
        }

        Mutasi::find($id)->update($data);

        toast('Data mutasi pegawai berhasil diperbarui', 'success');
        return redirect()->route('admin.mutasi.index');
    }

    public function destroy($id)
    {
        $mutasi = Mutasi::find($id);

        if ($mutasi->file_sk) {
            Storage::delete('public/dokumen/' . $mutasi->file_sk);
        }

        $mutasi->delete();

        return response()->json(['success' => true]);
    }

    public function showFile($id)
    {
        $mutasi = Mutasi::find($id);
        $filePath = storage_path('app/public/dokumen/'.$mutasi->file_sk);

        return response()->file($filePath);
    }
}
