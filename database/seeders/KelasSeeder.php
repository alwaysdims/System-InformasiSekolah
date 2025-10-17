<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        // Daftar nilai enum yang valid
        $tingkatOptions = ['X', 'XI', 'XII'];

        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'nama_kelas' => 'Kelas ' . $i,
                // Ambil salah satu dari enum secara acak
                'tingkat' => $tingkatOptions[array_rand($tingkatOptions)],
                'jurusan_id' => rand(1, 4),
                'wali_kelas_id' => rand(1, 15), // Guru ID
            ];
        }

        DB::table('kelas')->insert($data);
    }
}
