<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mapel')->insert([
            ['kode_mapel' => 'MAT', 'nama_mapel' => 'Matematika'],
            ['kode_mapel' => 'IND', 'nama_mapel' => 'Bahasa Indonesia'],
            ['kode_mapel' => 'PW', 'nama_mapel' => 'Pemprograman Web'],
            ['kode_mapel' => 'BD', 'nama_mapel' => 'Basis Data'],
            ['kode_mapel' => 'ENG', 'nama_mapel' => 'Bahasa Inggris'],
        ]);

    }
}
