<?php

namespace App\Http\Controllers\Guru\Kurikulum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KalenderPendidikanController extends Controller
{
    public function index()
    {
        return view('guru.kurikulum.kalenderPendidikan');
    }
}
