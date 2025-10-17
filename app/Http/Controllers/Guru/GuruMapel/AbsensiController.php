<?php

namespace App\Http\Controllers\Guru\Gurumapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(){
        return view('guru.gruumapel.absensi');
    }
}
