<?php

namespace App\Http\Controllers\Guru\Kurikulum;

use App\Http\Controllers\Controller;
use App\Models\KalenderPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KalenderPendidikanController extends Controller
{
    public function index()
    {
        $kalenderPendidikans = KalenderPendidikan::with('pembuat')->get();
        return view('guru.kurikulum.kalenderPendidikan', compact('kalenderPendidikans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'semester' => 'required|in:1,2',
            'kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        KalenderPendidikan::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'kegiatan' => $request->kegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'dibuat_oleh' => Auth::id(),
            'dibuat_pada' => now(),
        ]);

        return redirect()->route('kurikulum.kalenderPendidikan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, KalenderPendidikan $kalenderPendidikan)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'semester' => 'required|in:1,2',
            'kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $kalenderPendidikan->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'kegiatan' => $request->kegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('kurikulum.kalenderPendidikan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(KalenderPendidikan $kalenderPendidikan)
    {
        $kalenderPendidikan->delete();
        return redirect()->route('kurikulum.kalenderPendidikan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
