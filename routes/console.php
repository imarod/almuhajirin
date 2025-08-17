<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Inspiring; // Pastikan ini ada
use App\Console\Commands\AnnouncePendaftaran; // Tambahkan ini

// Kode untuk mendefinisikan Artisan Command 'inspire' (standar Laravel)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Kode untuk menjadwalkan command pengumuman Anda
Schedule::command(AnnouncePendaftaran::class)->everyMinute();