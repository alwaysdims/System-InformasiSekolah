<?php

namespace App\Http\Controllers\Guru\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\KehadiranSiswa;
use App\Models\PelanggaranSiswa;
use App\Models\Pengumuman;
use App\Models\Nilai;
use App\Models\Tugas;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function showLaporanSiswa(Request $request)
    {
        $query = Siswa::with(['kehadiran' => function ($q) use ($request) {
            if ($request->filled('bulan')) {
                $q->whereMonth('created_at', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $q->whereYear('created_at', $request->tahun);
            }
            if ($request->filled('status_kehadiran')) {
                $q->where('status', $request->status_kehadiran);
            }
            $q->latest()->limit(1);
        }, 'pelanggaran' => function ($q) use ($request) {
            if ($request->filled('bulan')) {
                $q->whereMonth('tanggal', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $q->whereYear('tanggal', $request->tahun);
            }
            if ($request->filled('jenis_pelanggaran')) {
                $q->where('jenis_pelanggaran', 'like', '%' . $request->jenis_pelanggaran . '%');
            }
            $q->latest()->limit(1);
        }]);

        $laporan = $query->get();
        $pengumuman = Pengumuman::latest('dibuat_pada')->first();

        return view('guru.kepalasekolah.laporan_siswa', compact('laporan', 'pengumuman'));
    }

    public function cetakLaporanSiswa(Request $request)
    {
        $query = Siswa::with(['kehadiran' => function ($q) use ($request) {
            if ($request->filled('bulan')) {
                $q->whereMonth('created_at', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $q->whereYear('created_at', $request->tahun);
            }
            if ($request->filled('status_kehadiran')) {
                $q->where('status', $request->status_kehadiran);
            }
            $q->latest()->limit(1);
        }, 'pelanggaran' => function ($q) use ($request) {
            if ($request->filled('bulan')) {
                $q->whereMonth('tanggal', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $q->whereYear('tanggal', $request->tahun);
            }
            if ($request->filled('jenis_pelanggaran')) {
                $q->where('jenis_pelanggaran', 'like', '%' . $request->jenis_pelanggaran . '%');
            }
            $q->latest()->limit(1);
        }]);

        $laporan = $query->get();
        $pengumuman = Pengumuman::latest('dibuat_pada')->first();

        $pdf = Pdf::loadView('guru.kepalasekolah.laporan_siswa_pdf', compact('laporan', 'pengumuman'));
        return $pdf->download('laporan_siswa.pdf');
    }

    public function showLaporanGuru(Request $request)
    {
        $query = Tugas::with(['nilai' => function ($q) use ($request) {
            if ($request->filled('bulan')) {
                $q->whereMonth('created_at', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $q->whereYear('created_at', $request->tahun);
            }
            if ($request->filled('nama_tugas')) {
                $q->whereHas('tugas', function ($q2) use ($request) {
                    $q2->where('nama_tugas', 'like', '%' . $request->nama_tugas . '%');
                });
            }
        }]);

        // Hitung statistik
        $statistik = $query->get()->map(function ($tugas) {
            $nilai = $tugas->nilai;
            return [
                'nama_tugas' => $tugas->nama_tugas,
                'rata_rata' => $nilai->avg('nilai') ?: 0,
                'nilai_tertinggi' => $nilai->max('nilai') ?: 0,
                'nilai_terendah' => $nilai->min('nilai') ?: 0,
                'jumlah_siswa' => $nilai->count(),
            ];
        });

        return view('guru.kepalasekolah.laporan_guru', compact('statistik'));
    }

    public function cetakLaporanGuru(Request $request)
    {
        $query = Tugas::with(['nilai' => function ($q) use ($request) {
            if ($request->filled('bulan')) {
                $q->whereMonth('created_at', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $q->whereYear('created_at', $request->tahun);
            }
            if ($request->filled('nama_tugas')) {
                $q->whereHas('tugas', function ($q2) use ($request) {
                    $q2->where('nama_tugas', 'like', '%' . $request->nama_tugas . '%');
                });
            }
        }]);

        $statistik = $query->get()->map(function ($tugas) {
            $nilai = $tugas->nilai;
            return [
                'nama_tugas' => $tugas->nama_tugas,
                'rata_rata' => $nilai->avg('nilai') ?: 0,
                'nilai_tertinggi' => $nilai->max('nilai') ?: 0,
                'nilai_terendah' => $nilai->min('nilai') ?: 0,
                'jumlah_siswa' => $nilai->count(),
            ];
        });

        $pdf = Pdf::loadView('guru.kepalasekolah.laporan_guru_pdf', compact('statistik'));
        return $pdf->download('laporan_guru.pdf');
    }
}
?>