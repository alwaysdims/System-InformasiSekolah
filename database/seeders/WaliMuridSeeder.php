<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliMuridSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wali_murid')->insert([
            'user_id' => 4,
            'nama' => 'Bapak Budi',
            'no_hp' => '081298765432',
            'alamat' => 'Jl. Mawar No.10',
        ]);
    }
}
