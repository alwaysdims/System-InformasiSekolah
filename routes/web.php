<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
});


// =============================
// Redirect sesuai role utama
// =============================
Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
Route::get('/siswa/dashboard', fn() => view('siswa.dashboard'))->name('siswa.dashboard');
Route::get('/wali/dashboard', fn() => view('wali.dashboard'))->name('wali.dashboard');

// =============================
// Guru & Jabatan Khusus
// =============================
Route::get('/guru/dashboard', fn() => view('guru.gurumapel.dashboard'))->name('guru.dashboard');
Route::get('/kepala/dashboard', fn() => view('guru.KepalaSekolah.dashboard'))->name('kepala.dashboard');
Route::get('/waka-kurikulum/dashboard', fn() => view('guru.kurikulum.dashboard'))->name('waka.kurikulum.dashboard');
Route::get('/waka-kesiswaan/dashboard', fn() => view('guru.kesiswaan.dashboard'))->name('waka.kesiswaan.dashboard');
Route::get('/bk/dashboard', fn() => view('guru.bk.dashboard'))->name('bk.dashboard');

// =============================
// Auth Proses
// =============================
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
