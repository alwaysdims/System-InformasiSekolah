<?php
// JadwalPelajaranSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPelajaranSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'kelas_id' => rand(1, 15),
                'guru_mapel_id' => rand(1, 15),
                'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'][rand(0,4)],
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '09:00:00',
            ];
        }
        DB::table('jadwal_pelajaran')->insert($data);
    }
}
