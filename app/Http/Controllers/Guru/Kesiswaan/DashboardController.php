<?php

namespace App\Http\Controllers\Guru\Kesiswaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'content' => 'guru.kesiswaan.dashboard',
            'title' => 'Dashboard Kesiswaan',
        ];
        return view('guru.kesiswaan.layout.wrapper', $data);
    }
}
