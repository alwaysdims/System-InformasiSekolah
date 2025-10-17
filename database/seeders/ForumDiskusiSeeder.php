<?php
// ForumDiskusiSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumDiskusiSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'guru_mapel_id' => rand(1, 15),
                'judul' => 'Forum ' . $i,
                'dibuat_oleh' => rand(1, 20),  // User ID
            ];
        }
        DB::table('forum_diskusi')->insert($data);
    }
}
