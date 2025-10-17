<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tugas')->insert(
            [
                'guru_mapel_id' => 1,
                'judul' => 'Ulangan harian IPA kelas XII',
                'deskripsi' => 'Kerjakan tugas dengan sungguh sungguh dan tanpa mencontek',
                'deadline' => date('Y-m-d-H-i-s'),
                'tipe' => 'Pilihan Ganda',
                'dibuat_pada' => now()
            ],
        );
    }
}
