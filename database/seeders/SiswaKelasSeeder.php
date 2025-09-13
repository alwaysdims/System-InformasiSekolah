<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaKelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa_kelas')->insert([
            'siswa_id'     => 1, // Adi Siswa
            'kelas_id'     => 1, // X RPL 1
            'tahun_ajaran' => '2025/2026',
        ]);
    }
}
