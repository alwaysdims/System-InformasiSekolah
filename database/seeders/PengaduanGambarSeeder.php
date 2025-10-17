<?php
// PengaduanGambarSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaduanGambarSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'pengaduan_id' => rand(1, 15),
                'file_path' => '/gambar/' . $i . '.jpg',
            ];
        }
        DB::table('pengaduan_gambar')->insert($data);
    }
}
