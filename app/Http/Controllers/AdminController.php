<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
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
        $dataUser = $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $dataUser['role'] = 'guru';
        $user = User::create($dataUser);

        $dataGuru = $request->except(['username', 'email', 'password', '_token']);
        $dataGuru['user_id'] = $user->id;
        $dataGuru['dibuat_pada'] = now();

        Guru::create($dataGuru);

        return redirect('/admin/dataGuru');
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
