<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelanggaranSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggaran_siswa')->insert([
            'siswa_id' => 1,
            'jenis_pelanggaran' => 'terlambat sekolah',
            'keterangan' => 'Mendapatkan 10 poin pelanggaran dikarenakan terlambat masuk sekolah',
            'tanggal' => date('Y-m-d'),
            'ditangani_oleh' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
