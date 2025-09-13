<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruMapelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru_mapel')->insert([
            'guru_id'    => 1, // Bapak Guru
            'mapel_id'   => 1, // Matematika
            'jurusan_id' => 1, // RPL
        ]);
    }
}
