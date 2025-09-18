<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Validator;

class DataJurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        $data = [
            'content' => 'admin.dataJurusan.index',
            'title' => 'Data Jurusan',
            'jurusans' => $jurusans
        ];
        return view('admin.layout.wrapper', $data);
    }

    public function create()
    {
        // Redirect to index with a flag to open the add modal
        return redirect()->route('admin.dataJurusan.index')->with('openAddModal', true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_jurusan' => 'required|string|max:20|unique:jurusan',
            'nama_jurusan' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.dataJurusan.index')->withErrors($validator)->withInput()->with('openAddModal', true);
        }

        Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('admin.dataJurusan.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Redirect to index with a flag to open the detail modal
        return redirect()->route('admin.dataJurusan.index')->with('openDetailModal', $id);
    }

    public function edit($id)
    {
        // Redirect to index with a flag to open the edit modal
        return redirect()->route('admin.dataJurusan.index')->with('openEditModal', $id);
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_jurusan' => 'required|string|max:20|unique:jurusan,kode_jurusan,' . $id,
            'nama_jurusan' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.dataJurusan.index')->withErrors($validator)->withInput()->with('openEditModal', $id);
        }

        $jurusan->update([
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('admin.dataJurusan.index')->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('admin.dataJurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}
