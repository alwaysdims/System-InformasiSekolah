<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DataGuruController;
use App\Http\Controllers\Admin\DataWaliController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataJurusanController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
});


// Contoh redirect sesuai role

// =============================
// route wali murid
// =============================




// =============================
// route admin
// =============================

// route admin data guru
Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/dataGuru', [DataGuruController::class, 'dataGuru'])->name('admin.data.guru');
Route::get('/admin/dataGuru/add', [DataGuruController::class, 'addGuru'])->name('admin.add.guru');
Route::get('/admin/dataGuru/details/{id}', [DataGuruController::class, 'detailsGuru'])->name('admin.details.guru');
Route::post('/admin/dataGuru/store', [DataGuruController::class, 'storeGuru'])->name('admin.store.guru');
Route::get('/admin/dataGuru/edit/{id}', [DataGuruController::class, 'editGuru'])->name(('admin.edit.guru'));
Route::put('/admin/dataGuru/update/{id}', [DataGuruController::class, 'updateGuru'])->name('admin.dataGuru.update');
Route::resource('dataGuru', DataGuruController::class);

// route data admin
Route::prefix('admin')->group(function () {
    Route::resource('dataAdmin', DataAdminController::class)->names('admin.dataAdmin');


    Route::resource('wali', DataWaliController::class)
        ->names('admin.wali_murid')
        ->parameters(['wali-murid' => 'id']);

    Route::resource('dataKelas', DataKelasController::class)
            ->names('admin.dataKelas')
            ->parameters(['dataKelas' => 'kelas']);

    Route::resource('dataJurusan', DataJurusanController::class)
            ->names('admin.dataJurusan')
            ->parameters(['dataJurusan' => 'jurusan']);

    Route::resource('dataSiswa', DataSiswaController::class)->names('admin.dataSiswa');


    Route::resource('dataMapel', DataMapelController::class)->names('admin.dataMapel');

});

// =============================
// end route admin
// =============================

// =============================
// Redirect sesuai role utama
// =============================
Route::get('/siswa/dashboard', fn() => view('siswa.dashboard'))->name('siswa.dashboard');
Route::get('/wali/dashboard', fn() => view('wali.dashboard'))->name('wali.dashboard');

// =============================
// route Guru & Jabatan Khusus dashboard
// =============================

Route::prefix('guru')->group(function () {
    Route::get('/kurikulum/dashboard', [App\Http\Controllers\Guru\Kurikulum\DashboardController::class, 'index'])->name('guru.kurikulum.dashboard');
    Route::get('/kesiswaan/dashboard', [App\Http\Controllers\Guru\Kesiswaan\DashboardController::class, 'index'])->name('guru.kesiswaan.dashboard');
    Route::get('/mapel/dashboard', [App\Http\Controllers\Guru\GuruMapel\DashboardController::class, 'index'])->name('guru.mapel.dashboard');
    Route::get('/kepala/dashboard', [App\Http\Controllers\Guru\KepalaSekolah\DashboardController::class, 'index'])->name('guru.kepala.dashboard');
    Route::get('/bk/dashboard', [App\Http\Controllers\Guru\Bk\DashboardController::class, 'index'])->name('guru.bk.dashboard');
});

Route::prefix('guru')->group(function () {

});

// =============================
// route kurikulum end
// =============================


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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
