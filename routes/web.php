<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;
use App\Models\Pendaftaran;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//layout app
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

// adminlte
// siswa
Route::get('/siswa/pendaftaran', [PendaftaranController::class, 'ajuanPendaftaran'])
    ->middleware('auth')
    ->name('ajuan.pendaftaran');
Route::get('/formulir-siswa', [App\Http\Controllers\PendaftaranController::class, 'index'])
    ->middleware('auth')
    ->name('formulir-siswa');
Route::post('/pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('pendaftaran/detail', [App\Http\Controllers\PendaftaranController::class, 'detailPendaftaran'])
    ->middleware('auth')
    ->name('pendaftaran.detail');
Route::get('formulir/edit{id}', [App\Http\Controllers\PendaftaranController::class, 'edit'])->name('formulir.edit');
Route::put('formulir/update/{id}', [App\Http\Controllers\PendaftaranController::class, 'update'])->name('formulir.update');



// admin
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    // Route::get('/data-pendaftar', [HomeController::class, 'dataPendaftar'])->name('admin.data-pendaftar');
    Route::get('/data-pendaftar', [AdminController::class, 'index'])->name('admin.pendaftar');

    Route::get('/dashboard-statistik', [HomeController::class, 'dashboardStatistik'])->name('admin.dashboard-statistik');
    Route::get('/detail-pendaftar', [HomeController::class, 'detailPendaftar'])->name('admin.detail-pendaftar');
});
