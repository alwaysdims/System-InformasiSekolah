<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'nama_kelas'    => 'XI RB',
                'tingkat'       => 'XI',
                'jurusan_id'    => 1,
                'wali_kelas_id' => 1,
            ],
            [
                'nama_kelas'    => 'XII TC',
                'tingkat'       => 'XII',
                'jurusan_id'    => 2,
                'wali_kelas_id' => 1,
            ],
            [
                'nama_kelas'    => 'XII RB',
                'tingkat'       => 'XII',
                'jurusan_id'    => 1,
                'wali_kelas_id' => 1,
            ],
            [
                'nama_kelas'    => 'XII OA',
                'tingkat'       => 'XII',
                'jurusan_id'    => 3,
                'wali_kelas_id' => 1,
            ],
        ]);
    }
}
