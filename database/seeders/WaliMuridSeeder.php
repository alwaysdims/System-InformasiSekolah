<?php
// WaliMuridSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliMuridSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'user_id' => 13 + $i,  // User wali
                'nama' => 'Wali ' . $i,
                'no_hp' => '084' . $i . '000',
                'alamat' => 'Alamat Wali ' . $i,
            ];
        }
        DB::table('wali_murid')->insert($data);
    }
}
