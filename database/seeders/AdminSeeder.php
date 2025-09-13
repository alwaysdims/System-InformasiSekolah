<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            'user_id' => 1, // admin01
            'nama'    => 'Super Admin',
            'no_hp'   => '081234567890',
        ]);
    }
}
