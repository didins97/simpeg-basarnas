<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $guarded = [];

    protected $appends = [
        'lama_kerja', 'usia'
    ];

    public function riwayatJabatan()
    {
        return $this->hasMany(NaikJabatan::class, 'pegawai_id', 'id');
    }

    public function riwayatMutasi()
    {
        return $this->hasMany(Mutasi::class, 'pegawai_id', 'id');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenPegawai::class, 'pegawai_id', 'id');
    }

    public function getLamaKerjaAttribute()
    {
        $tanggalMasuk = Carbon::parse($this->tanggal_masuk);
        $tanggalSekarang = Carbon::now();

        return $tanggalSekarang->diffInMonths($tanggalMasuk);
    }

    public function getUsiaAttribute()
    {
        $tanggalLahir = Carbon::parse($this->tgl_lahir);
        $tanggalSekarang = Carbon::now();

        return $tanggalSekarang->diffInYears($tanggalLahir);
    }

}
