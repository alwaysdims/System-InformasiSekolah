<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KehadiranSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kehadiran_siswa')->insert([
            [
                'siswa_id' => 1,
                'status' => 'hadir',
                'keterangan' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'siswa_id' => 1,
                'status' => 'hadir',
                'keterangan' => '',
                'created_at' => '2025-10-18',
                'updated_at' => now()
            ],
            [
                'siswa_id' => 1,
                'status' => 'tidak_hadir',
                'keterangan' => 'Sakit',
                'created_at' => '2025-10-19',
                'updated_at' => now()
            ],
        ]);
    }
}
