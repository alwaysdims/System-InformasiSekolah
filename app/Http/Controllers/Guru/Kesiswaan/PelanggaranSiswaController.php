<?php

namespace App\Http\Controllers\Guru\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\PelanggaranSiswa;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelanggaranSiswaController extends Controller
{
    /**
     * Menampilkan daftar pelanggaran siswa.
     */
    public function index()
    {
        $pelanggarans = PelanggaranSiswa::with(['siswa', 'ditanganiOleh'])
            ->latest()
            ->get();

        $siswas = Siswa::all();
        $gurus = Guru::all();

        $data = [
            'title' => 'Data Pelanggaran Siswa',
            'content' => 'guru.kesiswaan.pelanggaran.index',
            'pelanggarans' => $pelanggarans,
            'siswas' => $siswas,
            'gurus' => $gurus,
        ];

        return view('guru.kesiswaan.layout.wrapper', $data);
    }

    /**
     * Simpan data pelanggaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jenis_pelanggaran' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'ditangani_oleh' => 'nullable|exists:guru,id',
        ]);

        PelanggaranSiswa::create([
            'siswa_id' => $request->siswa_id,
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'ditangani_oleh' => $request->ditangani_oleh ?? Auth::id(),
        ]);

        return redirect()->route('guru.kesiswaan.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan.');
    }

    /**
     * Update data pelanggaran.
     */
    public function update(Request $request, $id)
    {
        $pelanggaran = PelanggaranSiswa::findOrFail($id);

        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jenis_pelanggaran' => 'required|string|max:150',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'ditangani_oleh' => 'nullable|exists:guru,id',
        ]);

        $pelanggaran->update([
            'siswa_id' => $request->siswa_id,
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'ditangani_oleh' => $request->ditangani_oleh ?? Auth::id(),
        ]);

        return redirect()->route('guru.kesiswaan.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    /**
     * Hapus pelanggaran siswa.
     */
    public function destroy($id)
    {
        PelanggaranSiswa::findOrFail($id)->delete();

        return redirect()->route('guru.kesiswaan.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}
