<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\DashboardAdmin;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\ManajemenJadwalPpdbController;
use App\Http\Controllers\Admin\ManajemenUser;
use App\Http\Controllers\Admin\KategoriPrestasiController;


use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\LoginTokenController;
use App\Http\Controllers\WilayahController;



Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard-statistik');
        }
        return redirect()->route('ajuan.pendaftaran');
    }
    return view('welcome');
})->name('root');

Auth::routes();


// Route::get('/test', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
// Route::get('test-email', [HomeController::class, 'testEmail'])->name('test.email');
// Route::get('/test-download-pdf', [HomeController::class, 'downloadPdf'])->name('test.download.pdf');


//siswa
Route::middleware('auth', 'is_siswa')->group(function () {
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
    Route::get('login/token/{token}', [LoginTokenController::class, 'login'])
        ->name('login.token');
    Route::get('siswa/daftar-cetak-formulir', [PendaftaranController::class, 'listCetakFormulir'])
        ->name('siswa.daftar-formulir');
    Route::get('siswa/cetak-formulir/{id}', [PendaftaranController::class, 'printPendaftaran'])
        ->name('cetak.formulir');
});

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
    Route::get('/detail-pendaftar/{id}', [VerifikasiController::class, 'showDetailPendaftar'])
        ->name('admin.detail-pendaftar');
    Route::put('/pendaftaran/{id}/update-status', [VerifikasiController::class, 'updateStatus'])
        ->name('admin.update-status');
    Route::post('/pendaftaran/{id}/perbaikan-status', [VerifikasiController::class, 'updatePerbaikanStatus'])
        ->name('admin.update-perbaikan-status');
    Route::delete('/data-pendaftar/{id}', [AdminController::class, 'destroy'])
        ->name('admin.data.pendaftar.destroy');
    Route::get('/data-pendaftar/export-csv', [AdminController::class, 'exportPendaftarToCsv'])
        ->name('admin.pendaftar.export-csv');
    Route::get('/data-pendaftar/export-pdf', [AdminController::class, 'exportPendaftarToPdf'])
        ->name('admin.pendaftar.export-pdf');

    Route::get('/manajemen-jadwal-ppdb', [ManajemenJadwalPpdbController::class, 'index'])
        ->name('admin.manajemen-jadwal-ppdb');
    Route::get('/manajemen-jadwal-ppdb/json', [ManajemenJadwalPpdbController::class, 'getDataJadwal'])
        ->name('admin.manajemen-jadwal-ppdb.json');
    Route::post('/manajemen-jadwal-ppdb', [ManajemenJadwalPpdbController::class, 'store'])
        ->name('admin.store-jadwal-ppdb');
    Route::get('/manajemen-jadwal-ppdb/{id}/edit', [ManajemenJadwalPpdbController::class, 'edit'])
        ->name('admin.edit-jadwal-ppdb');
    Route::put('/manajemen-jadwal-ppdb/{id}', [ManajemenJadwalPpdbController::class, 'update'])
        ->name('admin.update-jadwal-ppdb');
    Route::delete('/manajemen-jadwal-ppdb/{id}', [ManajemenJadwalPpdbController::class, 'destroy'])
        ->name('admin.destroy-jadwal-ppdb');
    Route::get('/cetak-jadwal/export-csv', [ManajemenJadwalPpdbController::class, 'exportJadwalToCsv'])
        ->name('admin.cetak-jadwal.export-csv');
    Route::get('/cetak-jadwal/export-pdf', [ManajemenJadwalPpdbController::class, 'exportJadwalToPdf'])
        ->name('admin.cetak-jadwal.export-pdf');

    Route::get('/manajemen-jurusan', [JurusanController::class, 'index'])
        ->name('admin.manajemen-jurusan');
    Route::post('/manajemen-jurusan', [JurusanController::class, 'store'])
        ->name('admin.manajemen-jurusan.store');
    Route::put('/manajemen-jurusan/{jurusan}', [JurusanController::class, 'update']) // {jurusan} akan di-resolve ke Model Jurusan
        ->name('admin.manajemen-jurusan.update');
    Route::delete('/manajemen-jurusan/{jurusan}', [JurusanController::class, 'destroy']) // {jurusan} akan di-resolve ke Model Jurusan
        ->name('admin.manajemen-jurusan.destroy');


    Route::get('/kategori-prestasi', [KategoriPrestasiController::class, 'index'])
        ->name('admin.kategori-prestasi');
    Route::post('/kategori-prestasi', [KategoriPrestasiController::class, 'store'])
        ->name('admin.kategori-prestasi.store');
    Route::put('/kategori-prestasi/{kategoriPrestasi}', [KategoriPrestasiController::class, 'update'])
        ->name('admin.kategori-prestasi.update');
    Route::delete('/kategori-prestasi/{kategoriPrestasi}', [KategoriPrestasiController::class, 'destroy'])
        ->name('admin.kategori-prestasi.destroy');



    Route::get('/manajemen-user', [ManajemenUser::class, 'index'])
        ->name('admin.manajemen-user');
    Route::get('/manajemen-user/counts', [ManajemenUser::class, 'getTotalUser'])
        ->name('admin.manajemen.user.counts');
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



    // Route::get('/dashboard', [HomeController::class, 'adminDashboard'])
    //     ->name('admin.dashboard');
    // Route::get('/data-pendaftar', [HomeController::class, 'dataPendaftar'])->name('admin.data-pendaftar');



});
