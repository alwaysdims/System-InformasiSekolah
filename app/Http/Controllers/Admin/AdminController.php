<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $data = [
            'content' => 'admin.dashboard.index',
            'title' => 'Dashboard'
        ];
        return view('layout.admin.wrapper', $data);
    }

    public function dataGuru() {
        $data = [
            'content' => 'admin.dataGuru.index',
            'title' => 'Data Guru',
            'guru' => Guru::select('id', 'nama', 'jenis_ptk', 'jabatan')->get()
        ];
        return view('layout.admin.wrapper', $data);
    }

    public function addGuru() {
        $data = [
            'content' => 'admin.dataGuru.add',
            'title' => 'Data Guru',
        ];
        return view('layout.admin.wrapper', $data);
    }

    public function storeGuru(Request $request) {
        // Validasi untuk user (akun login)
        $dataUser = $request->validate([
            'username' => 'required|string|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Simpan ke tabel users
        $dataUser['password'] = Hash::make($dataUser['password']);
        $dataUser['role'] = 'guru';
        $user = User::create($dataUser);

        // Validasi untuk tabel guru
        $dataGuru = $request->validate([
            'nip'            => 'nullable|string|max:30|unique:guru,nip',
            'nama'           => 'required|string|max:100',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'   => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
            'jenjang'        => 'required|in:D3,S1,S2,S3',
            'jurusan_kuliah' => 'nullable|string|max:150',
            'jenis_ptk'      => 'required|in:Guru,Tenaga Pendidikan',
            'status_kepeg'   => 'required|in:PNS,PPPK,Honorer Sekolah,Honorer Daerah',
            'jabatan'        => 'nullable|in:Kepala Sekolah,Waka Kurikulum,Waka Kesiswaan,Guru Mapel,BK',
            'alamat'         => 'nullable|string',
            'no_hp'          => 'nullable|string|max:20',
        ]);

        // Tambahkan user_id
        $dataGuru['user_id'] = $user->id;

        // created_at/dibuat_pada otomatis oleh DB, jadi tidak perlu diisi
        Guru::create($dataGuru);

        return redirect('/admin/dataGuru')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function detailsGuru($id) {
        $data = [
            'content' => 'admin.dataGuru.details',
            'title' => 'Data Guru',
            'guru' => Guru::where('id', decrypt($id))->get()
        ];
        return view('layout.admin.wrapper', $data);
    }

    public function editGuru($id) {
        $data = [
            'content' => 'admin.dataGuru.edit',
            'title' => 'Data Guru',
            'guru' => Guru::find(decrypt($id))
        ];
        return view('layout.admin.wrapper', $data);
    }

    public function updateGuru(Request $request, $id) {
        $dataGuru = $request->except('_token');
        $where = Guru::find(decrypt($id));

        $where->update($dataGuru);
        return redirect('/admin/dataGuru/details/' . encrypt($where->id));
    }

    public function destroy($id) {
        $where = Guru::find($id);
        $user = User::find($where['user_id']);
        $user->delete();
        $where->delete();

        return redirect('/admin/dataGuru');
    }
}
