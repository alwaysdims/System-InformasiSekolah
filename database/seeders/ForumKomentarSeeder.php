<?php
// ForumKomentarSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumKomentarSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'forum_id' => rand(1, 15),
                'user_id' => rand(1, 20),
                'komentar' => 'Komentar ' . $i,
            ];
        }
        DB::table('forum_komentar')->insert($data);
    }
}
