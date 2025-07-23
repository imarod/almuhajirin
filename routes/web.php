<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//layout app
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

// adminlte
// siswa
Route::get('/formulir-siswa', [App\Http\Controllers\HomeController::class, 'index'])->name('formulir-siswa');
Route::post('/pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'store'])->name('pendaftaran.store');


// admin
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    // Route::get('/data-pendaftar', [HomeController::class, 'dataPendaftar'])->name('admin.data-pendaftar');
    Route::get('/data-pendaftar', [AdminController::class, 'index'])->name('admin.pendaftar');

    Route::get('/dashboard-statistik', [HomeController::class, 'dashboardStatistik'])->name('admin.dashboard-statistik');
    Route::get('/detail-pendaftar', [HomeController::class, 'detailPendaftar'])->name('admin.detail-pendaftar');

});
