<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $tipeList = ['Pilihan Ganda', 'Essay','Campuran']; // ✅ enum disesuaikan

        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'guru_mapel_id' => rand(1, 15),
                'judul' => 'Tugas ' . $i,
                'deskripsi' => 'Desk ' . $i,
                'deadline' => now()->addDays($i),
                'publish_time' => now(),
                'tipe' => $tipeList[array_rand($tipeList)],
                'bobot_pg' => 50,
                'bobot_esai' => 50,
            ];
        }

        DB::table('tugas')->insert($data);
    }
}
