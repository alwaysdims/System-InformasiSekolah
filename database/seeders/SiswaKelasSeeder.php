<?php
// SiswaKelasSeeder.php (pivot)
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaKelasSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'siswa_id' => rand(1, 15),
                'kelas_id' => rand(1, 15),
                'tahun_ajaran' => '2023/2024',
            ];
        }
        DB::table('siswa_kelas')->insert($data);
    }
}
