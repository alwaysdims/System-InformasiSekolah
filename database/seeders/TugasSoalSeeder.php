<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSoalSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 30; $i++) {
            $data[] = [
                'tugas_id' => rand(1, 15),
                'pertanyaan' => 'Pertanyaan Pilihan Ganda ke-' . $i,
                'tipe' => 'Pilihan Ganda', // hanya tipe ini saja
                'pilihan_a' => 'Pilihan A',
                'pilihan_b' => 'Pilihan B',
                'pilihan_c' => 'Pilihan C',
                'pilihan_d' => 'Pilihan D',
                'jawaban_benar' => 'A',
            ];
        }

        DB::table('tugas_soal')->insert($data);
    }
}
