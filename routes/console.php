<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Inspiring; 
use App\Console\Commands\AnnouncePendaftaran; 
use App\Console\Commands\SendAnnouncementEmails;

// Kode untuk mendefinisikan Artisan Command 'inspire' (standar Laravel)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Kode untuk menjadwalkan command pengumuman Anda
Schedule::command(AnnouncePendaftaran::class)->everyMinute();
Schedule::command(SendAnnouncementEmails::class)->everyMinute();