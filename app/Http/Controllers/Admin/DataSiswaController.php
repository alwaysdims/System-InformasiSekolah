<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\WaliMurid;

class DataSiswaController extends Controller
{
    // Menampilkan semua siswa + data pendukung untuk modal
    public function index()
    {
        $siswa = Siswa::with(['user', 'kelas', 'jurusan', 'waliMurid'])->get();
        $users = User::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $waliMurid = WaliMurid::all();

        return view('admin.layout.wrapper', compact('siswa','users','kelas','jurusan','waliMurid'))
               ->with('content', 'admin.dataSiswa.index')
               ->with('title', 'Data Siswa');
    }

    // Simpan data siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'nis'            => 'nullable|unique:siswa,nis',
            'nama'           => 'required|string|max:100',
            'alamat'         => 'nullable|string',
            'no_hp'          => 'nullable|string|max:20',
            'kelas_id'       => 'nullable|exists:kelas,id',
            'jurusan_id'     => 'nullable|exists:jurusan,id',
            'wali_murid_ids' => 'nullable|array',
            'wali_murid_ids.*' => 'exists:wali_murid,id',
        ]);

        $siswa = Siswa::create($request->only([
            'user_id','nis','nama','alamat','no_hp','kelas_id','jurusan_id'
        ]));

        if($request->wali_murid_ids){
            $siswa->waliMurid()->sync($request->wali_murid_ids);
        }

        return redirect()->route('admin.dataSiswa.index')
                         ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // Update data siswa
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'nis'            => 'nullable|unique:siswa,nis,' . $siswa->id,
            'nama'           => 'required|string|max:100',
            'alamat'         => 'nullable|string',
            'no_hp'          => 'nullable|string|max:20',
            'kelas_id'       => 'nullable|exists:kelas,id',
            'jurusan_id'     => 'nullable|exists:jurusan,id',
            'wali_murid_ids' => 'nullable|array',
            'wali_murid_ids.*' => 'exists:wali_murid,id',
        ]);

        $siswa->update($request->only([
            'user_id','nis','nama','alamat','no_hp','kelas_id','jurusan_id'
        ]));

        $siswa->waliMurid()->sync($request->wali_murid_ids ?? []);

        return redirect()->route('admin.dataSiswa.index')
                         ->with('success', 'Data siswa berhasil diupdate.');
    }

    // Hapus data siswa
    public function destroy(Siswa $siswa)
    {
        $siswa->waliMurid()->detach();
        $siswa->delete();

        return redirect()->route('admin.dataSiswa.index')
                         ->with('success', 'Data siswa berhasil dihapus.');
    }
}
