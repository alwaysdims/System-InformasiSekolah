<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with(['jurusan', 'waliKelas'])->paginate(10);
        $jurusan = Jurusan::all();
        $guru = Guru::all();

        $data = [
            'content' => 'admin.dataKelas.index',
            'title' => 'Data Kelas',
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'guru' => $guru,
        ];
        return view('admin.layout.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        return view('admin.dataKelas.create', compact('jurusan', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:50',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'wali_kelas_id' => 'nullable|exists:guru,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        dd($request);
        Kelas::create($request->all());

        return redirect()->route('admin.dataKelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        $kelas->load(['jurusan', 'waliKelas']);
        return view('admin.dataKelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        return view('admin.dataKelas.edit', compact('kelas', 'jurusan', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:50',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'wali_kelas_id' => 'nullable|exists:guru,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $kelas->update($request->all());

        return redirect()->route('admin.dataKelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('admin.dataKelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}