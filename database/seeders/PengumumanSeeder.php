<?php
// PengumumanSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'judul' => 'Pengumuman ' . $i,
                'isi' => 'Isi ' . $i,
                'dibuat_oleh' => rand(1, 20),
            ];
        }
        DB::table('pengumuman')->insert($data);
    }
}
