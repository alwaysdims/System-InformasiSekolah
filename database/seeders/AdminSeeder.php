<?php
// AdminSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'user_id' => $i <= 3 ? $i : rand(1, 3),  // Link ke user admin
                'nama' => 'Admin ' . $i,
                'no_hp' => '081' . $i . '000',
            ];
        }
        DB::table('admin')->insert($data);
    }
}
