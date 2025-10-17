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
            JurusanSeeder::class,
            MapelSeeder::class,
            UserSeeder::class,
            AdminSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
            WaliMuridSeeder::class,
            KelasSeeder::class,
            GuruMapelSeeder::class,
            JadwalPelajaranSeeder::class,
            MateriSeeder::class,
            MateriKelasSeeder::class,
            TugasSeeder::class,
            TugasKelasSeeder::class,
            TugasSoalSeeder::class,
            TugasJawabanSeeder::class,
            NilaiSeeder::class,
            AgendaSeeder::class,
            KalenderPendidikanSeeder::class,
            ForumDiskusiSeeder::class,
            ForumKomentarSeeder::class,
            PengumumanSeeder::class,
            PengaduanSeeder::class,
            PengaduanGambarSeeder::class,
            PengaduanChatSeeder::class,
            PelanggaranSiswaSeeder::class,
            PrestasiSiswaSeeder::class,
            KehadiranSiswaSeeder::class,
            SiswaKelasSeeder::class,
            WaliMuridSiswaSeeder::class,
        ]);
    }
}
