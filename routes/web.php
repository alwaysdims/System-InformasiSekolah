<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
});


// Contoh redirect sesuai role

// route admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dataGuru', [AdminController::class, 'dataGuru'])->name('admin.data.guru');
Route::get('/admin/dataGuru/add', [AdminController::class, 'addGuru'])->name('admin.add.guru');
Route::get('/admin/dataGuru/details/{id}', [AdminController::class, 'detailsGuru'])->name('admin.details.guru');
Route::post('/admin/dataGuru/store', [AdminController::class, 'storeGuru'])->name('admin.store.guru');
Route::get('/admin/dataGuru/edit/{id}', [AdminController::class, 'editGuru'])->name(('admin.edit.guru'));
Route::put('/admin/dataGuru/update/{id}', [AdminController::class, 'updateGuru'])->name('admin.dataGuru.update');
Route::resource('dataGuru', AdminController::class);


Route::get('/guru/dashboard', fn() => 'Guru Dashboard')->name('guru.dashboard');
Route::get('/siswa/dashboard', fn() => 'Siswa Dashboard')->name('siswa.dashboard');
Route::get('/wali/dashboard', fn() => 'Wali Murid Dashboard')->name('wali.dashboard');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
