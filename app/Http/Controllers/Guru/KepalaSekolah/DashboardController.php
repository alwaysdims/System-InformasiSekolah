<?php

namespace App\Http\Controllers\Guru\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\KehadiranSiswa;
use App\Models\PelanggaranSiswa;
use App\Models\Pengumuman;
use App\Models\TugasJawaban;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik Siswa Terdaftar
        $totalSiswa = Siswa::count();
        $siswaPerKelas = Siswa::select('kelas.nama_kelas', DB::raw('count(siswa.id) as jumlah'))
            ->join('siswa_kelas', 'siswa.id', '=', 'siswa_kelas.siswa_id')
            ->join('kelas', 'siswa_kelas.kelas_id', '=', 'kelas.id')
            ->groupBy('kelas.nama_kelas')
            ->get();

        // Grafik Kehadiran per Kelas (Bulan Ini)
        $bulanIni = now()->month;
        $tahunIni = now()->year;
        $kehadiranPerKelas = Kelas::select('kelas.nama_kelas', DB::raw('ROUND(AVG(CASE WHEN kehadiran_siswa.status = "hadir" THEN 100 ELSE 0 END), 2) as persentase_hadir'))
            ->leftJoin('siswa_kelas', 'kelas.id', '=', 'siswa_kelas.kelas_id')
            ->leftJoin('siswa', 'siswa_kelas.siswa_id', '=', 'siswa.id')
            ->leftJoin('kehadiran_siswa', 'siswa.id', '=', 'kehadiran_siswa.siswa_id')
            ->whereMonth('kehadiran_siswa.created_at', $bulanIni)
            ->whereYear('kehadiran_siswa.created_at', $tahunIni)
            ->groupBy('kelas.id', 'kelas.nama_kelas')
            ->get();

        // Pelanggaran Bulanan (6 Bulan Terakhir)
        $pelanggaranBulanan = PelanggaranSiswa::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('YEAR(tanggal) as tahun'),
            DB::raw('COUNT(*) as jumlah')
        )
            ->where('tanggal', '>=', now()->subMonths(6))
            ->groupBy('bulan', 'tahun')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'bulan' => \Carbon\Carbon::create($item->tahun, $item->bulan, 1)->translatedFormat('M Y'),
                    'jumlah' => $item->jumlah,
                ];
            });

        // Progres Pembelajaran (Persentase Jawaban Tidak Null per Kelas)
        $progresPembelajaran = Kelas::select('kelas.nama_kelas', DB::raw('ROUND(AVG(CASE WHEN tugas_jawaban.jawaban IS NOT NULL THEN 100 ELSE 0 END), 2) as persentase_selesai'))
            ->leftJoin('siswa_kelas', 'kelas.id', '=', 'siswa_kelas.kelas_id')
            ->leftJoin('siswa', 'siswa_kelas.siswa_id', '=', 'siswa.id')
            ->leftJoin('tugas_jawaban', 'siswa.id', '=', 'tugas_jawaban.siswa_id')
            ->groupBy('kelas.id', 'kelas.nama_kelas')
            ->get();

        // Pengumuman Terbaru
        $pengumuman = Pengumuman::latest('dibuat_pada')->take(3)->get();

        return view('guru.kepalasekolah.dashboard', compact(
            'totalSiswa',
            'siswaPerKelas',
            'kehadiranPerKelas',
            'pelanggaranBulanan',
            'progresPembelajaran',
            'pengumuman'
        ));
    }
}
?>