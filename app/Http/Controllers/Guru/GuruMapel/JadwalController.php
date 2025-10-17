<?php

namespace App\Http\Controllers\Guru\GuruMapel;

use App\Models\Guru_Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar pembagian mata pelajaran guru hanya untuk guru yang login.
     */
    public function index()
    {
        // Ambil guru_id dari relasi User ke Guru
        $user = Auth::user();
        if (!$user || !$user->guru) {
            Log::error('Pengguna tidak memiliki relasi ke Guru.');
            return view('guru.gurumapel.jadwalMapel')
                ->with('error', 'Akun Anda tidak terkait dengan data guru.');
        }

        $guruId = $user->guru->id;
        Log::info('Guru ID yang login: ' . $guruId);

        // Ambil data guru_mapel untuk guru yang login
        $guruMapels = Guru_Mapel::where('guru_id', $guruId)
            ->with(['guru', 'mapel', 'jurusan'])
            ->whereHas('mapel') // Pastikan mapel ada
            ->whereHas('jurusan') // Pastikan jurusan ada
            ->get();

        Log::info('Jumlah guru_mapel: ' . $guruMapels->count());

        if ($guruMapels->isEmpty()) {
            Log::warning('Tidak ada Guru_Mapel untuk guru_id: ' . $guruId);
            return view('guru.gurumapel.jadwalMapel', compact('guruMapels'))
                ->with('error', 'Tidak ada data pembagian mata pelajaran untuk guru ini.');
        }

        return view('guru.gurumapel.jadwalMapel', compact('guruMapels'));
    }
}
