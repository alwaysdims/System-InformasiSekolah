<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaduanSeeder extends Seeder
{
    public function run()
    {
        $statusList = ['Menunggu', 'Diproses', 'Selesai'];
        $data = [];

        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'siswa_id' => rand(1, 15),
                'judul' => 'Pengaduan ' . $i,
                'isi' => 'Isi pengaduan nomor ' . $i . ' mengenai masalah di sekolah.',
                'status' => $statusList[array_rand($statusList)], // pilih acak antara Menunggu, Diproses, Selesai
                'dibuat_pada' => now(),
            ];
        }

        DB::table('pengaduan')->insert($data);
    }
}
