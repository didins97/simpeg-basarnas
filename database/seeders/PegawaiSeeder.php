<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('pegawai')->insert([
                'nip' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                't_lahir' => $faker->city,
                'tgl_lahir' => $faker->dateTimeBetween('1990-01-01', '2022-12-31'),
                'jns_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']),
                'status_maritai' => $faker->randomElement(['menikah', 'belum_menikah', 'janda_duda']),
                'foto' => null, // Isi dengan path foto jika ada
                'jabatan' => $faker->randomElement(['pegawai biasa', 'pegawai khusus', 'pegawai honorer']),
                'unit_kerja' => $faker->company,
                'tanggal_masuk' => $faker->date,
                'pend_terakhir' => $faker->randomElement(['SMA', 'D3', 'S1', 'S2', 'S3']),
                'nama_institut' => $faker->company,
                'jurusan' => $faker->word,
                'tahun_lulus' => $faker->dateTimeBetween('1990-01-01', '2022-12-31'),
                'alamat' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'nohp' => $faker->phoneNumber,
                'status_pegawai' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
