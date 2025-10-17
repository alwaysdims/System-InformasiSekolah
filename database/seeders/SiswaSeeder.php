<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 15; $i++) {
            $username = 'siswa' . $i;
            $email = $username . '@example.com';

            // ✅ Cek apakah user sudah ada agar tidak duplikat
            $existingUser = DB::table('users')->where('username', $username)->first();

            if (!$existingUser) {
                $userId = DB::table('users')->insertGetId([
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                ]);
            } else {
                $userId = $existingUser->id;
            }

            // ✅ Cek apakah siswa sudah ada agar tidak duplikat
            $existingSiswa = DB::table('siswa')->where('user_id', $userId)->first();

            if (!$existingSiswa) {
                $data[] = [
                    'user_id' => $userId,
                    'nis' => 'NIS' . $i,
                    'nama' => 'Siswa ' . $i,
                    'alamat' => 'Alamat Siswa ' . $i,
                    'no_hp' => '083' . $i . '000',
                    'jurusan_id' => rand(1, 4),
                ];
            }
        }

        if (!empty($data)) {
            DB::table('siswa')->insert($data);
        }
    }
}
