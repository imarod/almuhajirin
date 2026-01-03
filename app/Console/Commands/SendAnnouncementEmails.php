<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pendaftaran;
use App\Models\ManajemenJadwalPpdb;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResultNotificationMail;
use App\Traits\LoginTokenGenerator;
use Illuminate\Support\Facades\Log;

class SendAnnouncementEmails extends Command
{
    protected $signature = 'pendaftaran:send-emails';
    protected $description = 'Mengirim email pengumuman ke siswa yang terdaftar pada jadwal yang hari ini tanggal pengumumannya.';
    use LoginTokenGenerator;
    
    public function handle()
    {
        $todayDateString = Carbon::today()->toDateString();
        $this->info('Mencari jadwal pengumuman untuk tanggal hari ini: ' . $todayDateString);
        Log::info('Cron job SendAnnouncementEmails dijalankan. Mencari jadwal untuk tanggal: ' . $todayDateString);

        // Cari pengumuman hari ini
        $jadwals = ManajemenJadwalPpdb::whereDate('tgl_pengumuman', $todayDateString)->get();

        if ($jadwals->isEmpty()) {
            $this->info('Tidak ada jadwal pengumuman hari ini.');
            return Command::SUCCESS;
        }

        // terdapat jadwal pengumuman hari ini
        foreach ($jadwals as $jadwal) {

            // Ambil semua pendaftar untuk jadwal ini yang belum dikirimi email pengumuman
            $pendaftarToAnnounce = Pendaftaran::where('jadwal_id', $jadwal->id)
                ->where('pesan_email', false)
                ->get();

            if ($pendaftarToAnnounce->isEmpty()) {
                $this->info('Tidak ada pendaftar baru yang perlu diumumkan untuk jadwal ' . $jadwal->thn_ajaran . ' gelombang ' . $jadwal->gelombang_pendaftaran);
                continue;
            }

            $this->info('Mulai mengumumkan ' . $pendaftarToAnnounce->count() . ' Pendaftar untuk tahun ajaran ' . $jadwal->thn_ajaran . ' gelombang ' . $jadwal->gelombang_pendaftaran . '...');

            foreach ($pendaftarToAnnounce as $pendaftar) {
                if ($pendaftar->siswa && $pendaftar->siswa->email_siswa) {
                    $user = $pendaftar->siswa->user;
                    $plainToken = $this->generateLoginToken($user);

                    Mail::to($pendaftar->siswa->email_siswa)
                        ->queue(new ResultNotificationMail($pendaftar, $plainToken));

                    // Tandai bahwa email sudah dikirim dan status pengumuman sudah disetel
                    $pendaftar->pesan_email = true;
                    $pendaftar->is_announced = true;
                    $pendaftar->save();
                    $this->info('Email pengumuman dikirim ke: ' . $pendaftar->siswa->email_siswa);
                } else {
                    $this->warn('Pendaftar dengan ID ' . $pendaftar->id . ' tidak memiliki data siswa/email terdaftar. Melewati pengiriman email.');
                }
            }
        }
        $this->info('Pengiriman email pengumuman selesai.');
        return Command::SUCCESS;
    }
}
