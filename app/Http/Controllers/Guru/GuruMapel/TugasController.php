<?php

namespace App\Http\Controllers\Guru\GuruMapel;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Guru_Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::user()->guru || Auth::user()->guru->guruMapels->isEmpty()) {
            return redirect()->back()->with('error', 'Akun Anda tidak terkait dengan data Guru Mapel.');
        }

        $guruMapels = Auth::user()->guru->guruMapels()->with('mapel')->get();
        $kelas = Kelas::all();
        $tugas = Tugas::with(['guruMapel.mapel', 'kelas'])
            ->whereIn('guru_mapel_id', $guruMapels->pluck('id'))
            ->paginate(10);

        return view('guru.gurumapel.tugas', compact('tugas', 'guruMapels', 'kelas'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->guru || Auth::user()->guru->guruMapels->isEmpty()) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'guru_mapel_id' => 'required|exists:guru_mapel,id',
            'tipe' => 'required',
            'deadline' => 'required',
            'bobot_pg' => 'required|integer|min:0|max:100',
            'bobot_esai' => 'required|integer|min:0|max:100',
        ]);

        if (($request->bobot_pg + $request->bobot_esai) != 100) {
            return back()->withErrors(['bobot' => 'Total bobot harus 100%!'])->withInput();
        }

        // Cek ownership
        if (!Auth::user()->guru->guruMapels->contains($request->guru_mapel_id)) {
            return back()->with('error', 'Akses ditolak.');
        }

        Tugas::create($request->only([
            'judul', 'guru_mapel_id', 'tipe', 'deadline', 'bobot_pg', 'bobot_esai'
        ]));

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Tugas $tugas)
    {
        if (!Auth::check() || !Auth::user()->guru || !$tugas->guruMapel || !Auth::user()->guru->guruMapels->contains($tugas->guru_mapel_id)) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'guru_mapel_id' => 'required|exists:guru_mapel,id',
            'tipe' => 'required',
            'durasi' => 'required|integer|min:1|max:180',
            'bobot_pg' => 'required|integer|min:0|max:100',
            'bobot_esai' => 'required|integer|min:0|max:100',
        ]);

        if (($request->bobot_pg + $request->bobot_esai) != 100) {
            return back()->withErrors(['bobot' => 'Total bobot harus 100%!'])->withInput();
        }

        if (!Auth::user()->guru->guruMapels->contains($request->guru_mapel_id)) {
            return back()->with('error', 'Akses ditolak.');
        }

        $tugas->update($request->only([
            'judul', 'guru_mapel_id', 'tipe', 'durasi', 'bobot_pg', 'bobot_esai'
        ]));

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diupdate!');
    }

    public function destroy(Tugas $tugas)
    {
        if (!Auth::check() || !Auth::user()->guru || !$tugas->guruMapel || !Auth::user()->guru->guruMapels->contains($tugas->guru_mapel_id)) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $tugas->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus!');
    }

    public function publish(Request $request, Tugas $tugas)
    {
        if (!Auth::check() || !Auth::user()->guru || !$tugas->guruMapel || !Auth::user()->guru->guruMapels->contains($tugas->guru_mapel_id)) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'kelas_ids' => 'required|array|min:1',
            'kelas_ids.*' => 'exists:kelas,id',
            'publish_time' => 'required',
            'info' => 'nullable|string|max:500',
        ]);

        $tugas->kelas()->sync($request->kelas_ids);
        $tugas->update([
            'publish_time' => $request->publish_time,
            'deskripsi' => $request->info,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diterbitkan!');
    }

    public function hasil(Tugas $tugas)
    {
        if (!Auth::check() || !Auth::user()->guru || !$tugas->guruMapel || !Auth::user()->guru->guruMapels->contains($tugas->guru_mapel_id)) {
            abort(403);
        }

        // TODO: Load jawaban, soal, etc.
        return view('guru.gurumapel.tugas.hasil', compact('tugas')); // Buat view hasil nanti
    }
}
