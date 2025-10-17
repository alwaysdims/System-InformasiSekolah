<?php
// UserSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        // 3 Admin (ID 1-3)
        for ($i = 1; $i <= 3; $i++) {
            $data[] = [
                'username' => 'admin' . $i,
                'email' => 'admin' . $i . '@school.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ];
        }
        // 5 Guru (ID 4-8)
        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'username' => 'guru' . $i,
                'email' => 'guru' . $i . '@school.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ];
        }
        // 5 Siswa (ID 9-13)
        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'username' => 'siswa' . $i,
                'email' => 'siswa' . $i . '@school.com',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
            ];
        }
        // 2 Wali Murid (ID 14-15)
        for ($i = 1; $i <= 2; $i++) {
            $data[] = [
                'username' => 'wali' . $i,
                'email' => 'wali' . $i . '@school.com',
                'password' => Hash::make('password123'),
                'role' => 'wali_murid',
            ];
        }
        // Tambah hingga total 15 user dengan mix role
        for ($i = 16; $i <= 20; $i++) {  // Tambahan siswa/guru
            $data[] = [
                'username' => 'user' . $i,
                'email' => 'user' . $i . '@school.com',
                'password' => Hash::make('password123'),
                'role' => ($i % 2 == 0) ? 'siswa' : 'guru',
            ];
        }
        DB::table('users')->insert($data);
    }
}
