<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            'user_id'       => 3, // siswa01
            'nis'           => '2025001',
            'nama'          => 'Adi Siswa',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir'  => 'Bandung',
            'tanggal_lahir' => '2008-05-15',
            'alamat'        => 'Jl. Belajar No.2',
            'no_hp'         => '081377788899',
            'jurusan_id'    => 1, // RPL
        ]);
    }
}
