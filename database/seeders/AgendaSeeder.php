<?php
// AgendaSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendaSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'judul' => 'Agenda ' . $i,
                'deskripsi' => 'Desc ' . $i,
                'tanggal' => date('Y-m-d', strtotime('+'.$i.' days')),
                'dibuat_oleh' => rand(1, 15),  // Guru ID
            ];
        }
        DB::table('agenda')->insert($data);
    }
}
