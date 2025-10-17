<?php

namespace App\Http\Controllers;

// use App\Models\User;
use App\Models\Guru_mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember-me'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');

                case 'siswa':
                    return redirect()->route('siswa.dashboard');

                case 'wali_murid':
                    return redirect()->route('wali.dashboard');

                case 'guru':
                    // Ambil data jabatan guru
                    $guru = $user->guru; // relasi one-to-one ke tabel guru

                    if ($guru) {
                        switch ($guru->jabatan) {
                            case 'Kepala Sekolah':
                                return redirect()->route('kepala.dashboard');
                            case 'Waka Kurikulum':
                                return redirect()->route('waka.kurikulum.dashboard');
                            case 'Waka Kesiswaan':
                                return redirect()->route('waka.kesiswaan.dashboard');
                            case 'bk':
                                return redirect()->route('bk.dashboard');
                            default:
                                return redirect()->route('guru.dashboard'); // guru mapel biasa
                        }
                    }

                    return redirect()->route('guru.dashboard');

                default:
                    return redirect()->route('home');
            }
        }


        return back()->withErrors([
            'username' => 'Login gagal! Periksa kembali username/email dan password.',
        ])->onlyInput('username');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
