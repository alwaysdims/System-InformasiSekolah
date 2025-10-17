<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agenda')->insert([
            'judul' => 'Rapat TKA',
            'deskripsi' => 'Rapat akan dilaksanakan pada tanggal 11 Desember 2025 di ruang Multimedia',
            'tanggal' => '2025-12-1',
            'dibuat_oleh' => 1,
            'dibuat_pada' => now()
        ]);
    }
}
