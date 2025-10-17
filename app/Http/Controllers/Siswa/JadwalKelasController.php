<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Models\SiswaKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalKelasController extends Controller
{
    /**
     * Display the schedule for the student's class.
     */
    public function index()
    {
        // Get the authenticated user (assuming User model is linked to Siswa)
        $user = Auth::user();

        // Find the student's class for the current academic year
        $siswaKelas = SiswaKelas::where('siswa_id', $user->id)
        ->orderByDesc('tahun_ajaran')
        ->with('kelas')
        ->first();


        if (!$siswaKelas || !$siswaKelas->kelas) {
            return view('siswa.jadwal-kelas', [
                'kelas' => null,
                'jadwal' => [],
                'error' => 'Anda belum terdaftar di kelas manapun untuk tahun ajaran ini.'
            ]);
        }

        // Get the schedule for the student's class
        $jadwal = JadwalPelajaran::where('kelas_id', $siswaKelas->kelas_id)
            ->with(['guruMapel.guru', 'guruMapel.mapel'])
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('siswa.jadwal-kelas', [
            'kelas' => $siswaKelas->kelas,
            'jadwal' => $jadwal,
        ]);
    }
}
