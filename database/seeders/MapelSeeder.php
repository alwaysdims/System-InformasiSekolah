<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mapel')->insert([
            ['nama_mapel' => 'Matematika'],
            ['nama_mapel' => 'Bahasa Indonesia'],
            ['nama_mapel' => 'Pemprograman Web'],
            ['nama_mapel' => 'Basis Data'],
            ['nama_mapel' => 'Bahasa Inggris'],
        ]);
    }
}
