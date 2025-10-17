<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruMapelSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $uniqueCombinations = [];

        // Pastikan angka di bawah sesuai dengan isi tabel jurusan
        $maxGuru = DB::table('guru')->count();
        $maxMapel = DB::table('mapel')->count();
        $maxJurusan = DB::table('jurusan')->count(); // <-- ambil jumlah jurusan real dari DB

        $total = 15; // jumlah data yang mau dibuat

        while (count($data) < $total) {
            $guru_id = rand(1, $maxGuru);
            $mapel_id = rand(1, $maxMapel);
            $jurusan_id = rand(1, $maxJurusan); // pake jumlah jurusan real

            $key = "{$guru_id}-{$mapel_id}-{$jurusan_id}";

            if (!in_array($key, $uniqueCombinations)) {
                $uniqueCombinations[] = $key;

                $data[] = [
                    'guru_id' => $guru_id,
                    'mapel_id' => $mapel_id,
                    'jurusan_id' => $jurusan_id,
                ];
            }
        }

        DB::table('guru_mapel')->insert($data);
    }
}
