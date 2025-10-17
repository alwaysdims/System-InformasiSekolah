<?php

namespace App\Http\Controllers\Guru\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\PrestasiSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PrestasiSiswaController extends Controller
{
    /**
     * Menampilkan daftar prestasi siswa beserta form modal.
     */
    public function index()
    {
       // Ambil semua prestasi beserta relasi siswa
        $prestasis = PrestasiSiswa::with('siswa')
            ->latest()
            ->get();

        // Ambil semua siswa untuk select option di modal tambah/edit
        $siswas = Siswa::all();

        // Siapkan data untuk view
        $data = [
            'title' => 'Data Prestasi Siswa',
            'content' => 'guru.kesiswaan.prestasi.index',
            'prestasis' => $prestasis,
            'siswas' => $siswas,
        ];

        return view('guru.kesiswaan.layout.wrapper', $data);
    }

    /**
     * Simpan data prestasi siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'prestasi' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        PrestasiSiswa::create($request->only(['siswa_id', 'prestasi', 'keterangan', 'tanggal']));

        return redirect()->route('guru.kesiswaan.prestasi.index')
                         ->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    /**
 * Menampilkan detail prestasi siswa.
 */
public function show($id)
{
    $prestasi = PrestasiSiswa::with('siswa')->findOrFail($id);

    // Jika ingin return JSON (misal untuk AJAX)
    return response()->json([
        'id' => $prestasi->id,
        'siswa' => $prestasi->siswa->nama ?? '-',
        'prestasi' => $prestasi->prestasi,
        'keterangan' => $prestasi->keterangan,
        'tanggal' => $prestasi->tanggal,
    ]);
}


    /**
     * Update data prestasi siswa.
     */
    public function update(Request $request, $id)
    {
        $prestasi = PrestasiSiswa::findOrFail($id);

        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'prestasi' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $prestasi->update($request->only(['siswa_id', 'prestasi', 'keterangan', 'tanggal']));

        return redirect()->route('guru.kesiswaan.prestasi.index')
                         ->with('success', 'Data prestasi berhasil diperbarui.');
    }

    /**
     * Hapus prestasi siswa.
     */
    public function destroy($id)
    {
        PrestasiSiswa::findOrFail($id)->delete();

        return redirect()->route('guru.kesiswaan.prestasi.index')
                         ->with('success', 'Data prestasi berhasil dihapus.');
    }
}
