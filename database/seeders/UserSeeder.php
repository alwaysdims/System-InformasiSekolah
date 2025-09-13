<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin01',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
            ],
            [
                'username' => 'guru01',
                'email' => 'guru@example.com',
                'password' => Hash::make('password'),
                'role' => 'guru',
                'created_at' => now(),
            ],
            [
                'username' => 'siswa01',
                'email' => 'siswa@example.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'created_at' => now(),
            ],
            [
                'username' => 'wali01',
                'email' => 'wali@example.com',
                'password' => Hash::make('password'),
                'role' => 'wali_murid',
                'created_at' => now(),
            ],
        ]);
    }
}
