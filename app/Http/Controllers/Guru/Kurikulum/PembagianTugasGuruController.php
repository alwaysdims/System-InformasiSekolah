<?php

namespace App\Http\Controllers\Guru\Kurikulum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Jurusan;
use App\Models\Guru_Mapel;

class PembagianTugasGuruController extends Controller
{
    public function index()
    {
        $guruMapel = Guru_Mapel::with(['guru', 'mapel', 'jurusan'])->get();
        $guru = Guru::all();
        $mapel = Mapel::all();
        $jurusan = Jurusan::all();

        return view('guru.kurikulum.jadwalguru', compact('guruMapel', 'guru', 'mapel', 'jurusan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'mapel_id' => 'required|exists:mapel,id',
            'jurusan_id' => 'nullable|exists:jurusan,id',
        ]);

        Guru_Mapel::create($validated);
        return redirect()->route('kurikulum.pembagianTugasGuru.index')->with('success', 'Pembagian tugas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'mapel_id' => 'required|exists:mapel,id',
            'jurusan_id' => 'nullable|exists:jurusan,id',
        ]);

        $guruMapel = Guru_Mapel::findOrFail($id);
        $guruMapel->update($validated);
        return redirect()->route('kurikulum.pembagianTugasGuru.index')->with('success', 'Pembagian tugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $guruMapel = Guru_Mapel::findOrFail($id);
        $guruMapel->delete();
        return redirect()->route('kurikulum.pembagianTugasGuru.index')->with('success', 'Pembagian tugas berhasil dihapus');
    }
}
