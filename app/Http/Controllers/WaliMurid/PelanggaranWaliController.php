<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use App\Models\PelanggaranSiswa;
use Illuminate\Http\Request;

class PelanggaranWaliController extends Controller
{
    public function index() {
        $data = [
            'content' => 'wali.pelanggaran',
            'title' => 'Pelanggaran',
            'pelanggaran' => PelanggaranSiswa::latest()->get()
        ];
        return view('wali.layout.wrapper', $data);
    }
}
