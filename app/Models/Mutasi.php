<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\DokumenPegawai;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $dokumen = new DokumenPegawai();
            $dokumen->nama_dokumen = 'file sk'.
            $dokumen->jenis_dokumen = 'sk_mutasi';
            $dokumen->pegawai_id = $model->pegawai_id;
            $dokumen->tanggal_upload = Carbon::now();
            $dokumen->lokasi_file = $model->file_sk;
            $dokumen->save();
        });

        // static::updating(function ($model) {
        //     if ($model->isDirty('file_sk')) {
        //         $dokumen = Dokumen::where('pegawai_id', $model->pegawai_id)->where('jenis_file', 'SK_PROMOSI')->first();
        //         $dokumen->lokasi_file = $model->pegawai_id.'_'.'sk_promosi'.'_'.$model->file_sk->getClientOriginalName();
        //         $dokumen->save();
        //     }
        // });

        // static::deleting(function ($model) {
        //     $dokumen = Dokumen::where('pegawai_id', $model->pegawai_id)->where('jenis_file', 'SK_PROMOSI')->first();
        //     $dokumen->delete();
        // });
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
