<?php

namespace App\Http\Controllers\Guru\Kurikulum;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Guru_Mapel;
use Illuminate\Http\Request;

class PembagianJadwalPerkelasController extends Controller
{
    public function index()
    {
        $jadwalPelajarans = JadwalPelajaran::with(['kelas', 'guruMapel.guru', 'guruMapel.mapel'])->get();
        $kelas = Kelas::all();
        $guruMapels = Guru_Mapel::with(['guru', 'mapel'])->get();
        return view('guru.kurikulum.jadwalKelas', compact('jadwalPelajarans', 'kelas', 'guruMapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'guru_mapel_id' => 'required|exists:guru_mapel,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPelajaran::create($request->only(['kelas_id', 'guru_mapel_id', 'hari', 'jam_mulai', 'jam_selesai']));

        return redirect()->route('kurikulum.jadwalKelas.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, JadwalPelajaran $jadwalPelajaran)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'guru_mapel_id' => 'required|exists:guru_mapel,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwalPelajaran->update($request->only(['kelas_id', 'guru_mapel_id', 'hari', 'jam_mulai', 'jam_selesai']));

        return redirect()->route('kurikulum.jadwalKelas.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(JadwalPelajaran $jadwalPelajaran)
    {
        $jadwalPelajaran->delete();
        return redirect()->route('kurikulum.jadwalKelas.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
