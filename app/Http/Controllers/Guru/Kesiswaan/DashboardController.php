<?php

namespace App\Http\Controllers\Guru\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\PelanggaranSiswa;
use App\Models\PrestasiSiswa;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung data untuk widget
        $totalSiswa = Siswa::count();
        $totalPelanggaran = PelanggaranSiswa::count();
        $totalPrestasi = PrestasiSiswa::count();

        // Kirim semua data ke wrapper view
        $data = [
            'title' => 'Dashboard Kesiswaan',
            'content' => 'guru.kesiswaan.dashboard',
            'totalSiswa' => $totalSiswa,
            'totalPelanggaran' => $totalPelanggaran,
            'totalPrestasi' => $totalPrestasi,
        ];

        return view('guru.kesiswaan.layout.wrapper', $data);
    }
}
