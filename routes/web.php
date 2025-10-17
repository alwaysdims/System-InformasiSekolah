<?php

use App\Http\Controllers\Landing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DataGuruController;
use App\Http\Controllers\Admin\DataWaliController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataKelasController;
use App\Http\Controllers\Admin\DataMapelController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\DataJurusanController;
use App\Http\Controllers\Siswa\RuangDiskusiController;
use App\Http\Controllers\WaliMurid\NilaiWaliController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\WaliMurid\AgendaWaliController;
use App\Http\Controllers\WaliMurid\PrestasiWaliController;
use App\Http\Controllers\WaliMurid\KehadiranWaliController;
use App\Http\Controllers\Guru\GuruMapel\PengaduanController;
use App\Http\Controllers\WaliMurid\PelanggaranWaliController;
use App\Http\Controllers\Guru\KepalaSekolah\LaporanController;
use App\Http\Controllers\Guru\KepalaSekolah\DashboardController;
use App\Http\Controllers\Guru\Kesiswaan\PrestasiSiswaController;
use App\Http\Controllers\WaliMurid\DashboardWaliMuridController;
use App\Http\Controllers\Guru\Kesiswaan\PelanggaranSiswaController;
use App\Http\Controllers\Guru\kurikulum\KalenderPendidikanController;
use App\Http\Controllers\Guru\kurikulum\PembagianTugasGuruController;
use App\Http\Controllers\Guru\Kurikulum\PembagianJadwalPerkelasController;

Route::get('/', function () {
    return view('landing.landing');
})->name('landing');

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


Route::get('/profil', [Landing::class, 'profil'])->name('profil');
Route::get('/sejarah', [Landing::class, 'sejarah'])->name('sejarah');
Route::get('/ekstrakulikuler', [Landing::class, 'ekstrakulikuler'])->name('ekstrakulikuler');
Route::get('/sambutan', [Landing::class, 'sambutan'])->name('sambutan');

// =============================
// Redirect sesuai role utama
// =============================

//Wali murid
Route::prefix('wali')->group(function () {
    Route::get('/dashboard', [DashboardWaliMuridController::class, 'index'])->name('wali.dashboard');

    Route::get('/prestasi', [PrestasiWaliController::class, 'index']);
    Route::get('/pelanggaran', [PelanggaranWaliController::class, 'index']);
    Route::get('/agenda', [AgendaWaliController::class, 'index']);
    Route::get('/nilai', [NilaiWaliController::class, 'index']);
    Route::get('/kehadiran', [KehadiranWaliController::class, 'index']);
});

Route::prefix('siswa')->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('siswa.dashboard'))->name('siswa.dashboard');

    // Tugas/Ujian (Resource + Custom Routes)
    Route::resource('/tugas', \App\Http\Controllers\Siswa\TugasController::class)->names('siswa.tugas');
    Route::get('tugas/{tugas}/detail', [\App\Http\Controllers\Siswa\TugasController::class, 'detail'])->name('siswa.tugas.detail');
    Route::get('tugas/{tugas}/kerjakan', [\App\Http\Controllers\Siswa\TugasController::class, 'kerjakan'])->name('siswa.tugas.kerjakan');
    Route::post('tugas/{tugas}/submit', [\App\Http\Controllers\Siswa\TugasController::class, 'submit'])->name('siswa.tugas.submit');
    Route::get('tugas/{tugas}/pilga', [\App\Http\Controllers\Siswa\TugasController::class, 'pilga'])->name('siswa.tugas.pilga');
    Route::get('tugas/{tugas}/esay', [\App\Http\Controllers\Siswa\TugasController::class, 'esay'])->name('siswa.tugas.esay');

    // Jadwal Kelas (Resource)
    Route::resource('/jadwal-kelas', \App\Http\Controllers\Siswa\JadwalKelasController::class)->names('siswa.jadwal-kelas');

    // Pengaduan (Resource)
    Route::resource('/pengaduan', \App\Http\Controllers\Siswa\PengaduanController::class)->names('siswa.pengaduan');

    // Ruang Diskusi (Resource)
    // Fetch comments for a specific forum
    Route::get('/ruang-diskusi/{forum}/komentar', [RuangDiskusiController::class, 'getKomentar'])->name('siswa.ruang-diskusi.komentar');

    // Store a new comment
    Route::post('siswa/ruang-diskusi/{forum}/komentar', [RuangDiskusiController::class, 'store'])
    ->name('siswa.ruang-diskusi.komentar');

});

// =============================
// route Guru & Jabatan Khusus dashboard
// =============================

Route::prefix('waka-kurikulum')->group(function () {
    Route::get('/dashboard', fn() => view('guru.kurikulum.dashboard'))->name('waka.kurikulum.dashboard');

    Route::resource('kalenderPendidikan', KalenderPendidikanController::class)->names('kurikulum.kalenderPendidikan');
    Route::resource('pembagianTugasGuru', PembagianTugasGuruController::class)->names('kurikulum.pembagianTugasGuru');
    Route::resource('jadwalKelas', PembagianJadwalPerkelasController::class)
    ->names('kurikulum.jadwalKelas')
    ->parameters(['jadwalKelas' => 'jadwalPelajaran']);
});


// =============================
// route kurikulum end
// =============================

// =============================
// Guru & Jabatan Khusus
// =============================

Route::prefix('guru')->group(function () {
    Route::get('/dashboard', fn() => view('guru.gurumapel.dashboard'))->name('guru.dashboard');
    // Add more routes as needed
    Route::resource('materi', \App\Http\Controllers\Guru\GuruMapel\MateriPelajaranController::class)->names('guru.materi');
    Route::post('materi/{materi}/publish', [\App\Http\Controllers\Guru\GuruMapel\MateriPelajaranController::class, 'publish'])->name('guru.materi.publish');

    Route::resource('tugas', \App\Http\Controllers\Guru\GuruMapel\TugasController::class)->names('guru.tugas');
    Route::post('tugas/{tugas}/publish', [\App\Http\Controllers\Guru\GuruMapel\TugasController::class, 'publish'])->name('guru.tugas.publish');
    Route::get('tugas/{tugas}/hasil', [\App\Http\Controllers\Guru\GuruMapel\TugasController::class, 'hasil'])->name('guru.tugas.hasil');
    Route::get('tugas/{tugas}/jawaban/{siswa}', [\App\Http\Controllers\Guru\GuruMapel\TugasController::class, 'detailJawaban'])->name('guru.tugas.detail-jawaban');

    Route::get('detail-soal/{id}', [\App\Http\Controllers\Guru\GuruMapel\BuatSoalController::class, 'index'])->name('guru.detail.tugas');
    Route::get('detail-soal/{id}/esay', [\App\Http\Controllers\Guru\GuruMapel\BuatSoalController::class, 'esay'])->name('guru.esay.tugas');
    Route::get('detail-soal/{id}/pilga', [\App\Http\Controllers\Guru\GuruMapel\BuatSoalController::class, 'pilga'])->name('guru.pilga.tugas');

    // Di dalam Route::prefix('guru')->group(function () {
    Route::post('detail-soal/{tugas}/pilga', [\App\Http\Controllers\guru\gurumapel\BuatSoalController::class, 'storePilga'])->name('guru.pilga.store');
    Route::post('detail-soal/{tugas}/esay', [\App\Http\Controllers\guru\gurumapel\BuatSoalController::class, 'storeEsay'])->name('guru.esay.store');
    Route::delete('soal/{soal}', [\App\Http\Controllers\guru\gurumapel\BuatSoalController::class, 'destroy'])->name('guru.soal.destroy');

    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('guru.pengaduan');
    Route::post('/pengaduan/{pengaduanId}/response', [PengaduanController::class, 'storeResponse'])->name('guru.pengaduan.response');
});

// kesiswaan
Route::prefix('guru/kesiswaan')
    ->name('guru.kesiswaan.') // semua route di dalam ini akan otomatis diawali nama guru.kesiswaan.*
    ->group(function () {

        // DASHBOARD WAKA KESISWAAN
        Route::get('/dashboard', fn() => view('guru.kesiswaan.dashboard'))
            ->name('dashboard');

        // DATA PELANGGARAN SISWA (CRUD)
        Route::resource('pelanggaran', PelanggaranSiswaController::class)
            ->parameters(['pelanggaran' => 'pelanggaranSiswa'])
            ->names([
                'index' => 'pelanggaran.index',
                'create' => 'pelanggaran.create',
                'store' => 'pelanggaran.store',
                'show' => 'pelanggaran.show',
                'edit' => 'pelanggaran.edit',
                'update' => 'pelanggaran.update',
                'destroy' => 'pelanggaran.destroy',
            ]);

        // DATA PRESTASI SISWA (CRUD)
        Route::resource('prestasi', PrestasiSiswaController::class)
            ->parameters(['prestasi' => 'prestasiSiswa'])
            ->names([
                'index' => 'prestasi.index',
                'create' => 'prestasi.create',
                'store' => 'prestasi.store',
                'show' => 'prestasi.show',
                'edit' => 'prestasi.edit',
                'update' => 'prestasi.update',
                'destroy' => 'prestasi.destroy',
            ]);

        // // LAYANAN ADUAN SISWA
        // Route::get('/pengaduan', [PengaduanController::class, 'index'])
        //     ->name('pengaduan.index');
        // Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])
        //     ->name('pengaduan.show');
        // Route::post('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])
        //     ->name('pengaduan.status');

        // // Chat interaktif pengaduan
        // Route::get('/pengaduan/{pengaduan}/chat', [PengaduanChatController::class, 'index'])
        //     ->name('pengaduan.chat');
        // Route::post('/pengaduan/{pengaduan}/chat', [PengaduanChatController::class, 'store'])
        //     ->name('pengaduan.chat.store');

        // // LAPORAN & REKAP
        // Route::get('/laporan', [LaporanKesiswaanController::class, 'index'])
        //     ->name('laporan.index');
        // Route::get('/laporan/export/pdf', [LaporanKesiswaanController::class, 'exportPdf'])
        //     ->name('laporan.export.pdf');
        // Route::get('/laporan/export/excel', [LaporanKesiswaanController::class, 'exportExcel'])
        //     ->name('laporan.export.excel');
    });



Route::get('/kepala/dashboard', [DashboardController::class, 'index'])->name('kepala.dashboard');
Route::get('/kepala/laporan/siswa', [LaporanController::class, 'showLaporanSiswa'])->name('kepala.laporan_siswa');
Route::get('/kepala/laporan/guru', [LaporanController::class, 'showLaporanGuru'])->name('kepala.laporan_guru');
Route::get('/kepala/laporan/siswa/cetak', [LaporanController::class, 'cetakLaporanSiswa'])->name('kepala.cetak_laporan_siswa');
Route::get('/kepala/laporan/guru/cetak', [LaporanController::class, 'cetakLaporanGuru'])->name('kepala.cetak_laporan_guru');

// Route::get('/waka-kurikulum/dashboard', fn() => view('guru.kurikulum.dashboard'))->name('waka.kurikulum.dashboard');
Route::get('/waka-kesiswaan/dashboard', fn() => view('guru.kesiswaan.dashboard'))->name('waka.kesiswaan.dashboard');
Route::get('/bk/dashboard', fn() => view('guru.bk.dashboard'))->name('bk.dashboard');

// =============================
// Auth Proses
// =============================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
