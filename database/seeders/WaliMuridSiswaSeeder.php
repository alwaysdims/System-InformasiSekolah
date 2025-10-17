<?php
// WaliMuridSiswaSeeder.php (pivot)
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliMuridSiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'wali_murid_id' => rand(1, 15),
                'siswa_id' => rand(1, 15),
                'hubungan' => 'Orang Tua',
            ];
        }
        DB::table('wali_murid_siswa')->insert($data);
    }
}
