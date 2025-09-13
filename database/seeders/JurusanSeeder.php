<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jurusan')->insert([
            ['kode_jurusan' => 'RPL', 'nama_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['kode_jurusan' => 'TPK', 'nama_jurusan' => 'Teknik Pembuatan Kain'],
            ['kode_jurusan' => 'OT',  'nama_jurusan' => 'Teknik Ototronik'],
            ['kode_jurusan' => 'TM',  'nama_jurusan' => 'Teknik Mesin'],
        ]);
    }
}
