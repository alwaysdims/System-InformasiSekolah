<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutannya penting karena ada relasi antar tabel
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            GuruSeeder::class,
            JurusanSeeder::class,
            MapelSeeder::class,
            GuruMapelSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            SiswaKelasSeeder::class,
        ]);
    }
}
