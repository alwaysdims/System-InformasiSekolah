<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardWaliMuridController extends Controller
{
    public function index() {
        $data = [
            'content' => 'wali.dashboard',
            'title' => 'Dashboard'
        ];
        return view('wali.layout.wrapper', $data);
    }
}
