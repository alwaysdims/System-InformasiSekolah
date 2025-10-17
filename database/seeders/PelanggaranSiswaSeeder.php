<?php
// PelanggaranSiswaSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelanggaranSiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'siswa_id' => rand(1, 15),
                'jenis_pelanggaran' => 'Terlambat',
                'keterangan' => 'Ket ' . $i,
                'tanggal' => date('Y-m-d'),
                'ditangani_oleh' => rand(1, 15),  // Guru
            ];
        }
        DB::table('pelanggaran_siswa')->insert($data);
    }
}
