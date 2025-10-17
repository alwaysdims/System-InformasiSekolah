<?php
// PengaduanChatSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaduanChatSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'pengaduan_id' => rand(1, 15),
                'user_id' => rand(1, 20),
                'pesan' => 'Pesan ' . $i,
            ];
        }
        DB::table('pengaduan_chat')->insert($data);
    }
}
