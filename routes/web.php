<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
});


// Contoh redirect sesuai role
Route::get('/admin/dashboard', fn() => 'Admin Dashboard')->name('admin.dashboard');
Route::get('/guru/dashboard', fn() => 'Guru Dashboard')->name('guru.dashboard');
Route::get('/siswa/dashboard', fn() => 'Siswa Dashboard')->name('siswa.dashboard');
Route::get('/wali/dashboard', fn() => 'Wali Murid Dashboard')->name('wali.dashboard');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
