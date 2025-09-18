<?php

<<<<<<< HEAD
=======
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\AuthController;
>>>>>>> 1e22eb0 (Siswa)
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DataWaliController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataJurusanController;
use App\Http\Controllers\Admin\DataKelasController;

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
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dataGuru', [AdminController::class, 'dataGuru'])->name('admin.data.guru');
Route::get('/admin/dataGuru/add', [AdminController::class, 'addGuru'])->name('admin.add.guru');
Route::get('/admin/dataGuru/details/{id}', [AdminController::class, 'detailsGuru'])->name('admin.details.guru');
Route::post('/admin/dataGuru/store', [AdminController::class, 'storeGuru'])->name('admin.store.guru');
Route::get('/admin/dataGuru/edit/{id}', [AdminController::class, 'editGuru'])->name(('admin.edit.guru'));
Route::put('/admin/dataGuru/update/{id}', [AdminController::class, 'updateGuru'])->name('admin.dataGuru.update');
Route::resource('dataGuru', AdminController::class);

// route data admin
Route::prefix('admin')->group(function () {
    Route::resource('dataAdmin', DataAdminController::class)->names('admin.dataAdmin');
<<<<<<< HEAD

    Route::resource('wali', DataWaliController::class)
        ->names('admin.wali_murid')
        ->parameters(['wali-murid' => 'id']);

    Route::resource('dataKelas', DataKelasController::class)
            ->names('admin.dataKelas')
            ->parameters(['dataKelas' => 'kelas']);

    Route::resource('dataJurusan', DataJurusanController::class)
            ->names('admin.dataJurusan')
            ->parameters(['dataJurusan' => 'jurusan']);
=======
    Route::resource('dataSiswa', DataSiswaController::class)->names('admin.dataSiswa');
>>>>>>> 1e22eb0 (Siswa)
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
