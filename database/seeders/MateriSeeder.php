<?php
// MateriSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'guru_mapel_id' => rand(1, 15),
                'judul' => 'Materi ' . $i,
                'deskripsi' => 'Deskripsi ' . $i,
                'file_path' => '/files/materi' . $i . '.pdf',
            ];
        }
        DB::table('materi')->insert($data);
    }
}
