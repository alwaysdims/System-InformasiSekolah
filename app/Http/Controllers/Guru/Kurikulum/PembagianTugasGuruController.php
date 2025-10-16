<?php

namespace App\Http\Controllers\Guru\Kurikulum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembagianTugasGuruController extends Controller
{
    public function index(){
        return view('guru.kurikulum.jadwalGuru');
    }
}
