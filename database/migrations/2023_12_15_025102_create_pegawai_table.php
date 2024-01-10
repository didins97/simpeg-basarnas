<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('t_lahir');
            $table->date('tgl_lahir');
            $table->string('jns_kelamin');
            $table->string('agama');
            $table->enum('status_maritai', ['menikah', 'belum_menikah', 'janda_duda']);
            $table->string('foto')->nullable();
            $table->string('jabatan');
            $table->string('unit_kerja');
            $table->date('tanggal_masuk');
            $table->string('pend_terakhir');
            $table->string('nama_institut');
            $table->string('jurusan');
            $table->string('tahun_lulus');
            $table->text('alamat');
            $table->string('email');
            $table->string('nohp');
            $table->boolean('status_pegawai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
