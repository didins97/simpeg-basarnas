<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\NaikJabatan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NaikJabatanController extends Controller
{
public function index()
{
    $pegawaiList = Pegawai::latest()->get();
    $jabatanList = NaikJabatan::latest()->get();

    return view('admin.naik_jabatan.index', compact('pegawaiList', 'jabatanList'));
}

public function store(Request $request) {
    $request->validate([
        'tgl_promosi' => 'required',
        'jabatan_sebelum' => 'required',
        'jabatan_baru' => 'required',
        'file_sk' => 'required',
        'pegawai_id' => 'required',
    ]);

    $data = $request->all();
    $data['file_sk'] = upload_file('public/dokumen', $request->file('file_sk'), $request->pegawai_id);
    // $data['status'] = 1;

    NaikJabatan::create($data);

    Pegawai::where('id', $data['pegawai_id'])->update(['jabatan' => $data['jabatan_baru']]);

    toast('Data naik jabatan berhasil ditambahkan', 'success');
    return redirect()->route('admin.promosi.index');
}

public function edit($id)
{
    $jabatan = NaikJabatan::with('pegawai')->find($id);
    return response()->json($jabatan);
}

public function update(Request $request, $id) {
    $request->validate([
        'tgl_promosi' => 'required',
        'jabatan_sebelum' => 'required',
        'jabatan_baru' => 'required',
        'pegawai_id' => 'required',
    ]);

    $jabatan = NaikJabatan::find($id);

    $data = $request->all();

    if ($request->hasFile('file_sk')) {
        $data['file_sk'] = upload_file('public/dokumen', $request->file('file_sk'), $request->pegawai_id);
        Storage::delete('public/dokumen/' . $jabatan->file_sk);
    }

    $jabatan->update($data);

    toast('Data naik jabatan berhasil diperbarui', 'success');
    return redirect()->route('admin.promosi.index');
}

public function destroy($id) {
    $jabatan = NaikJabatan::find($id);

    if ($jabatan->file_sk) {
        File::delete('storage/dokumen/'.$jabatan->file_sk);
    }

    if ($jabatan->status == 1) {
        $jabatan->pegawai()->update(['jabatan' => $jabatan->jabatan_sebelum]);
    }

    $jabatan->delete();

    return response()->json(['success' => true]);
}

public function showFile($id) {
    $jabatan = NaikJabatan::find($id);
    $filePath = storage_path('app/public/dokumen/'.$jabatan->file_sk);

    return response()->file($filePath);
}
}
