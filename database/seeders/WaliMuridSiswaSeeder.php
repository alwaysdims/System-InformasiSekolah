<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliMuridSiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wali_murid_siswa')->insert([
            'wali_murid_id' => 1, // id dari wali_murid
            'siswa_id' => 1, // id dari siswa (Adi Siswa)
            'hubungan' => 'Ayah',
        ]);
    }
}
