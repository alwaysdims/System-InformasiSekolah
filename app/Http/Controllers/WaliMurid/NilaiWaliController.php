<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use App\Models\TugasJawaban;
use App\Models\User;
use App\Models\WaliMurid;
use App\Models\WaliMuridSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiWaliController extends Controller
{
    public function index() {
        $wali = WaliMurid::where('nama', 'Bapak Budi')->first(); //nko di ganti nganggo Auth::user()->id
        $waliSiswa = WaliMuridSiswa::where('wali_murid_id', $wali->id)->first();
        $data = [
            'content' => 'wali.nilai',
            'title' => 'Nilai',
            'nilai' => TugasJawaban::where('siswa_id', $waliSiswa->siswa_id)->select('tugas_id', DB::raw('SUM(nilai) as total_nilai'))->groupBy('tugas_id')->get()
        ];
        return view('wali.layout.wrapper', $data);
    }
}
