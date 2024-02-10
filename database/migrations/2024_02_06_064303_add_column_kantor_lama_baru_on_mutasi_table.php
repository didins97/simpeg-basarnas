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
        Schema::table('mutasi', function (Blueprint $table) {
            $table->string('kantor_baru')->nullable();
            $table->string('kantor_lama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->dropColumn('kantor_baru');
            $table->dropColumn('kantor_lama');
        });
    }
};
