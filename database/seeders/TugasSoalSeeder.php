<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tugas_soal')->insert([
            [
                'tugas_id' => 1,
                'pertanyaan' => 'Ikan bernafas menggunakan apa?',
                'tipe' => 'Pilihan Ganda',
                'pilihan_a' => 'dummy',
                'pilihan_b' => 'dummy',
                'pilihan_c' => 'dummy',
                'pilihan_d' => 'dummy',
                'jawaban_benar' => 'a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tugas_id' => 1,
                'pertanyaan' => 'Manusia bernafas dengan menghirup apa?',
                'tipe' => 'Pilihan Ganda',
                'pilihan_a' => 'dummy',
                'pilihan_b' => 'dummy',
                'pilihan_c' => 'dummy',
                'pilihan_d' => 'dummy',
                'jawaban_benar' => 'b',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tugas_id' => 1,
                'pertanyaan' => 'Paus bernafas menggunakan...',
                'tipe' => 'Pilihan Ganda',
                'pilihan_a' => 'dummy',
                'pilihan_b' => 'dummy',
                'pilihan_c' => 'dummy',
                'pilihan_d' => 'dummy',
                'jawaban_benar' => 'a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tugas_id' => 1,
                'pertanyaan' => 'Tumbuhan menyerap air dari tanah menggunakan...',
                'tipe' => 'Pilihan Ganda',
                'pilihan_a' => 'dummy',
                'pilihan_b' => 'dummy',
                'pilihan_c' => 'dummy',
                'pilihan_d' => 'dummy',
                'jawaban_benar' => 'd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
