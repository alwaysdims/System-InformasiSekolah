<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KehadiranSiswaSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['hadir', 'tidak_hadir']; // sesuai ENUM di tabel
        $data = [];

        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'siswa_id' => rand(1, 15),
                'status' => $statuses[array_rand($statuses)],
                'keterangan' => 'Keterangan kehadiran siswa ke-' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('kehadiran_siswa')->insert($data);
    }
}
