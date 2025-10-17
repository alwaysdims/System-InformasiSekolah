<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasKelasSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $usedCombinations = []; // simpan pasangan unik

        $totalTugas = DB::table('tugas')->count();
        $totalKelas = DB::table('kelas')->count();

        // Buat 15 data acak, tapi unik
        for ($i = 1; $i <= 15; $i++) {
            do {
                $tugasId = rand(1, $totalTugas);
                $kelasId = rand(1, $totalKelas);
                $key = $tugasId . '-' . $kelasId;
            } while (isset($usedCombinations[$key])); // ulang sampai unik

            $usedCombinations[$key] = true;

            $data[] = [
                'tugas_id' => $tugasId,
                'kelas_id' => $kelasId,
            ];
        }

        DB::table('tugas_kelas')->insert($data);
    }
}
