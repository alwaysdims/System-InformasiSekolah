<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru')->insert([
            'user_id'       => 2, // guru01
            'nip'           => '1987654321',
            'nama'          => 'Bapak Guru',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir'  => 'Jakarta',
            'tanggal_lahir' => '1980-01-01',
            'jenjang'       => 'S1',
            'jurusan_kuliah'=> 'Pendidikan Matematika',
            'jenis_ptk'     => 'Guru',
            'status_kepeg'  => 'PNS',
            'jabatan'       => 'Guru Mapel',
            'alamat'        => 'Jl. Pendidikan No.1',
            'no_hp'         => '081298765432',
            'dibuat_pada'   => now(),
        ]);
    }
}
