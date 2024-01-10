<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawaiModel = \App\Models\Pegawai::query();

        $totalPegawai = $pegawaiModel->count();
        $totalPegawaiAktif = $pegawaiModel->clone()->where('status_pegawai', true)->count();
        $totalPegawaiMenikah = $pegawaiModel->clone()->where('status_maritai', 'menikah')->count();
        $totalPegawaiSMAKeatas = $pegawaiModel->clone()
            ->whereNotNull('pend_terakhir')
            ->whereNotIn('pend_terakhir', ['SMA', 'SMK', 'SMP', 'SD'])
            ->count();
        $totalPegawaiPria = $pegawaiModel->clone()->where('jns_kelamin', 'Laki-laki')->count();
        $totalPegawaiWanita = $pegawaiModel->clone()->where('jns_kelamin', 'Perempuan')->count();

        $totalUser = \App\Models\User::count();
        $totalJabatan = \App\Models\NaikJabatan::count();
        $totalMutasi = \App\Models\Mutasi::count();

        return view('admin.dashboard', compact(
            'totalPegawai',
            'totalPegawaiAktif',
            'totalPegawaiMenikah',
            'totalPegawaiSMAKeatas',
            'totalPegawaiPria',
            'totalPegawaiWanita',
            'totalUser',
            'totalJabatan',
            'totalMutasi'
        ));
    }
}
