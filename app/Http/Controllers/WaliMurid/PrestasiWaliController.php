<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use App\Models\PrestasiSiswa;
use Illuminate\Http\Request;

class PrestasiWaliController extends Controller
{
    public function index() {
        $data = [
            'content' => 'wali.prestasi',
            'title' => 'Prestasi',
            'prestasi' => PrestasiSiswa::latest()->get()
        ];
        return view('wali.layout.wrapper', $data);
    }
}
