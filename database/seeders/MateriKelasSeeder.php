<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriKelasSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $kombinasi = []; // untuk melacak pasangan unik

        for ($i = 1; $i <= 15; $i++) {
            $materi_id = rand(1, 15);
            $kelas_id = rand(1, 15);

            // buat kunci unik
            $key = $materi_id . '-' . $kelas_id;

            // jika sudah ada kombinasi ini, skip
            if (isset($kombinasi[$key])) {
                continue;
            }

            $kombinasi[$key] = true;

            $data[] = [
                'materi_id' => $materi_id,
                'kelas_id' => $kelas_id,
            ];
        }

        DB::table('materi_kelas')->insert($data);
    }
}
