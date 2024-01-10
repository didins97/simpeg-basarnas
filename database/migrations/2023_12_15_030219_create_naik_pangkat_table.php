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
        Schema::create('naik_pangkat', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_promosi');
            $table->string('jabatan_sebelum');
            $table->string('jabatan_baru');
            $table->string('file_sk');
            $table->unsignedBigInteger('pegawai_id');
            // $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('naik_pangkat');
    }
};
