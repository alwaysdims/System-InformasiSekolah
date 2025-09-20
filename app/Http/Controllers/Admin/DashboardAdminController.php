<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index() {
        $data = [
            'content' => 'admin.dashboard.index',
            'title' => 'Dashboard',
            'admin' => Guru::count(),
            'guru' => Siswa::count(),
            'siswa' => Mapel::count(),
            'wali' => Jurusan::count()
        ];
        return view('admin.layout.wrapper', $data);
    }
}
