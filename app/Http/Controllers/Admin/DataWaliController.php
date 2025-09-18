<?php

namespace App\Http\Controllers\Admin;

use App\Models\WaliMurid;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataWaliController extends Controller
{
    public function index()
    {
        $waliMurids = WaliMurid::with('user')->get();

        $data = [
            'content' => 'admin.datawali.index',
            'title' => 'Daftar Wali Murid',
            'waliMurids' => $waliMurids,
        ];
        return view('admin.layout.wrapper', $data);
    }

    public function create()
    {
        return view('wali_murid.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        WaliMurid::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.wali_murid.index')->with('success', 'Wali Murid berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $waliMurid = WaliMurid::with('user')->findOrFail($id);
        return view('wali_murid.edit', compact('waliMurid'));
    }

    public function update(Request $request, $id)
    {
        $waliMurid = WaliMurid::findOrFail($id);
        $user = $waliMurid->user;

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $waliMurid->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.wali_murid.index')->with('success', 'Wali Murid berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $waliMurid = WaliMurid::findOrFail($id);
        $waliMurid->delete();

        return redirect()->route('admin.wali_murid.index')->with('success', 'Wali Murid berhasil dihapus.');
    }

    public function show($id)
    {
        $waliMurid = WaliMurid::with('user', 'siswa')->findOrFail($id);
        return view('wali_murid.show', compact('waliMurid'));
    }
}