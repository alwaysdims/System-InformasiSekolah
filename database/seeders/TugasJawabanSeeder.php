<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasJawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tugas_jawaban')->insert([
            [
                'tugas_id' => 1,
                'siswa_id' => 1,
                'soal_id' => 1,
                'jawaban' => 'Menggunakan insang',
                'nilai' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tugas_id' => 1,
                'siswa_id' => 1,
                'soal_id' => 2,
                'jawaban' => 'Oksigen',
                'nilai' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tugas_id' => 1,
                'siswa_id' => 1,
                'soal_id' => 3,
                'jawaban' => 'Paru-paru',
                'nilai' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tugas_id' => 1,
                'siswa_id' => 1,
                'soal_id' => 4,
                'jawaban' => 'Akar',
                'nilai' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
