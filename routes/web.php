<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\ManajemenJadwalPpdb;
use App\Http\Controllers\ManajemenJadwalPpdbController;
use App\Http\Controllers\ManajemenUser;
use App\Http\Controllers\PendaftaranController;
use App\Models\Pendaftaran;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//layout app
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

// adminlte
// siswa



Route::middleware('auth')->group(function () {
    Route::get('/siswa/pendaftaran', [PendaftaranController::class, 'listPendaftar'])
        ->name('ajuan.pendaftaran');

    Route::get('/formulir-siswa', [PendaftaranController::class, 'index'])
        ->name('formulir-siswa');

    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');

    Route::get('formulir/edit/{id}', [PendaftaranController::class, 'index'])
        ->name('formulir.edit');
    Route::put('formulir/update/{id}', [PendaftaranController::class, 'update'])
        ->name('formulir.update');

    Route::delete('pendaftaran/{id}', [PendaftaranController::class, 'destroy'])
        ->name('pendaftaran.destroy');

    //cetak pendaftaran
    Route::get('siswa/daftar-cetak-formulir', [PendaftaranController::class, 'listCetakFormulir'])
        ->name('siswa.daftar-formulir');

    Route::get('siswa/cetak-formulir/{id}', [PendaftaranController::class, 'printPendaftaran'])
        ->name('cetak.formulir');
});

// Route::get('/siswa/pendaftaran', [PendaftaranController::class, 'ajuanPendaftaran'])
//     ->middleware('auth')
//     ->name('ajuan.pendaftaran');
// Route::get('/formulir-siswa', [App\Http\Controllers\PendaftaranController::class, 'index'])
//     ->middleware('auth')
//     ->name('formulir-siswa');
//////////////////

///////////////

// route pendaftaran/detail emang belum dibuat detailnya
// Route::get('pendaftaran/detail', [App\Http\Controllers\PendaftaranController::class, 'detailPendaftaran'])
//     ->middleware('auth')
//     ->name('pendaftaran.detail'); 






// admin
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard-statistik', [DashboardAdmin::class, 'index'])
        ->name('admin.dashboard-statistik');
    Route::get('/dashboard/data-counts', [DashboardAdmin::class, 'getTotalPendaftar'])
        ->name('admin.dashboard.data-counts');
    Route::get('/dashboard/data-gender', [DashboardAdmin::class, 'getPendaftarByGender'])
        ->name('admin.dashboard.data-gender');
    Route::get('/dashboard/data-prestasi', [DashboardAdmin::class, 'getPendaftarByPrestasi'])
        ->name('admin.dashboard.data-prestasi');
    Route::get('/dashboard/data-pendaftar-gelombang', [DashboardAdmin::class, 'getPendaftarByYearAndWave'])
        ->name('admin.dashboard.data-pendaftar-gelombang');





    Route::get('/data-pendaftar', [AdminController::class, 'showDataPendaftar'])
        ->name('admin.pendaftar');
    Route::get('/data-pendaftar/json', [AdminController::class, 'getDataPendaftar'])
        ->name('admin.pendaftar.json');
    Route::get('/detail-pendaftar', [AdminController::class, 'showDetailPendaftar'])
        ->name('admin.detail-pendaftar');
    Route::get('/detail-pendaftar/{id}', [AdminController::class, 'showDetailPendaftar'])
        ->name('admin.detail-pendaftar');
    Route::put('/pendaftaran/{id}/update-status', [AdminController::class, 'updateStatus'])
        ->name('admin.update-status');
    Route::delete('/data-pendaftar/{id}', [AdminController::class, 'destroy'])
        ->name('admin.data.pendaftar.destroy');


    Route::get('/manajemen-jadwal-ppdb', [ManajemenJadwalPpdbController::class, 'index'])
        ->name('admin.manajemen-jadwal-ppdb');
    Route::post('/manajemen-jadwal-ppdb', [ManajemenJadwalPpdbController::class, 'store'])
        ->name('admin.store-jadwal-ppdb');
    Route::get('/manajemen-jadwal-ppdb/{id}/edit', [ManajemenJadwalPpdbController::class, 'edit'])
        ->name('admin.edit-jadwal-ppdb');
    Route::put('/manajemen-jadwal-ppdb/{id}', [ManajemenJadwalPpdbController::class, 'update'])
        ->name('admin.update-jadwal-ppdb');
    Route::delete('/manajemen-jadwal-ppdb/{id}', [ManajemenJadwalPpdbController::class, 'destroy'])
        ->name('admin.destroy-jadwal-ppdb');


    Route::get('/manajemen-user', [ManajemenUser::class, 'index'])
        ->name('admin.manajemen-user');
    Route::post('/manajemen-user-store', [ManajemenUser::class, 'store'])
        ->name(('admin.manajemen.user.store'));
    Route::get('/manajemen-user/json', [ManajemenUser::class, 'getDataUser'])
        ->name('admin.manajemen.user.json');
    Route::delete('/manajemen-user/{id}', [ManajemenUser::class, 'destroy'])
        ->name('admin.manajemen.user.destroy');
    Route::get('/manajemen-user/{id}/edit', [ManajemenUser::class, 'edit'])
        ->name('admin.manajemen.user.edit');
    Route::put('/manajemen-user/{id}', [ManajemenUser::class, 'update'])
        ->name('admin.manajemen.user');



    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])
        ->name('admin.dashboard');
    // Route::get('/data-pendaftar', [HomeController::class, 'dataPendaftar'])->name('admin.data-pendaftar');



});
