<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Guru;

class Landing extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $jumlah_mapel = Mapel::count();
        $jumlah_siswa = Siswa::count();
        $jumlah_guru  = Guru::count();

        // Kirim ke view
        return view('landing.landing', compact(
            'jumlah_mapel',
            'jumlah_siswa',
            'jumlah_guru'
        ));
    }

    public function profil()
    {
        return view('landing.profil');
    }
    public function sejarah()
    {
        return view('landing.sejarah');
    }
    public function ekstrakulikuler()
    {
        return view('landing.ekstrakulikuler');
    }
    public function sambutan()
    {
        return view('landing.sambutan');
    }
    
}
