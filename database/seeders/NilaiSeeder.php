<?php
// NilaiSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'siswa_id' => rand(1, 15),
                'tugas_id' => rand(1, 15),
                'nilai' => rand(50, 100),
            ];
        }
        DB::table('nilai')->insert($data);
    }
}
