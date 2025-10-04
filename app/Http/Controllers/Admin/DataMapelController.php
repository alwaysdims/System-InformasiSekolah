<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class DataMapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::all();

        $data = [
            'content' => 'admin.dataMapel.index',
            'title' => 'Data Mapel',
            'mapels' => $mapels
        ];
        return view('admin.layout.wrapper', $data);
    }

    public function create()
    {
        return view('admin.dataMapel.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|string|max:20|unique:mapel',
            'nama_mapel' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Mapel::create($request->all());
        return redirect()->route('admin.dataMapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('admin.datMapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|string|max:20|unique:mapel,kode_mapel,'.$id,
            'nama_mapel' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mapel = Mapel::findOrFail($id);
        $mapel->update($request->all());
        return redirect()->route('admin.dataMapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();
        return redirect()->route('admin.dataMapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
