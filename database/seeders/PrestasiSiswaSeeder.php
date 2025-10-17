<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prestasi_siswa')->insert([
            'siswa_id' => 1,
            'prestasi' => 'Juara 1 Lomba Melukis',
            'keterangan' => 'Memenangkan lomba melukis tingkat kabupaten dengan menduduki peringkat 1.',
            'tanggal' => date('Y-m-d'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
