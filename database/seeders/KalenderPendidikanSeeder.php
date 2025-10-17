<?php
// KalenderPendidikanSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KalenderPendidikanSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'tahun_ajaran' => '2023/2024',
                'semester' => '1',
                'kegiatan' => 'Kegiatan ' . $i,
                'tanggal_mulai' => date('Y-m-d', strtotime('+'.$i.' days')),
                'tanggal_selesai' => date('Y-m-d', strtotime('+'.($i+1).' days')),
                'dibuat_oleh' => rand(1, 20),  // User ID
                'dibuat_pada' => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('kalender_pendidikan')->insert($data);
    }
}
