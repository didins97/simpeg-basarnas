<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NaikPangkatSeeder extends Seeder
{
    public function run()
    {
        // Generate sample data for the naik_pangkat table
        $naikPangkatData = [];

        for ($i = 1; $i <= 50; $i++) {
            $naikPangkatData[] = [
                'tgl_naik' => now()->subDays($i),
                'unit_kerja' => 'Unit Kerja ' . $i,
                'nomor_sk' => 'SK' . $i,
                'file_sk' => 'sk_file' . $i . '.pdf',
                'pegawai_id' => $i,
                'created_at' => now()->subDays($i),
                'updated_at' => now()->subDays($i),
            ];
        }

        // Insert data into the naik_pangkat table
        DB::table('naik_pangkat')->insert($naikPangkatData);
    }
}
