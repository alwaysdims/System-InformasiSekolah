<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaWaliController extends Controller
{
    public function index() {
        $data = [
            'content' => 'wali.agenda',
            'title' => 'Agenda',
            'agenda' => Agenda::all()
        ];
        return view('wali.layout.wrapper', $data);
    }
}
