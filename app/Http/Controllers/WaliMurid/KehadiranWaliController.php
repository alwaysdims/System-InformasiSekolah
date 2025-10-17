<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use App\Models\KehadiranSiswa;
use App\Models\WaliMurid;
use App\Models\WaliMuridSiswa;
use Illuminate\Http\Request;

class KehadiranWaliController extends Controller
{
    public function index(){
        $wali = WaliMurid::where('nama', 'Bapak Budi')->first(); //nko diganti nganggo Atuh::user()->id yoan
        $waliSiswa = WaliMuridSiswa::where('wali_murid_id', $wali->id)->first();
        $kehadiran = KehadiranSiswa::where('siswa_id', $waliSiswa->siswa_id)
            ->get(['status', 'keterangan', 'created_at']);

        // Format untuk FullCalendar
        $events = $kehadiran->map(function ($item) {
            return [
                'title' => ucfirst(str_replace('_', ' ', $item->status)),
                'start' => $item->created_at->format('Y-m-d'),
                'color' => $item->status === 'hadir' ? '#22c55e' : '#ef4444',
                'extendedProps' => [
                    'keterangan' => $item->keterangan
                ]
            ];
        });


        $data = [
            'content' => 'wali.kehadiran',
            'title' => 'Kehadiran',
            'events' => $events
        ];
        return view('wali.layout.wrapper', $data);
    }
}
