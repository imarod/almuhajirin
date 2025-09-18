<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pendaftaran;
use App\Models\ManajemenJadwalPpdb;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResultNotificationMail;
use LDAP\Result;

class SendAnnouncementEmails extends Command
{
    protected $signature = 'pendaftaran:send-emails';
    protected $description = 'Mengirim email pengumuman ke siswa yang terdaftar pada jadwal yang hari ini tanggal pengumumannya.';

    public function handle()
    {
        $today = Carbon::today();

        $jadwals = ManajemenJadwalPpdb::whereDate('tgl_pengumuman', $today)->get();

        if ($jadwals->isEmpty()) {
            $this->info('Tidak ada jadwal pengumuman hari ini.');
            return Command::SUCCESS;
        }

        foreach ($jadwals as $jadwal) {
            $pendaftarToAnnounce = Pendaftaran::where('jadwal_id', $jadwal->id)
                ->where('is_announced', false)
                ->get();

             if ($pendaftarToAnnounce->isEmpty()) {
                $this->info('Tidak ada pendaftar yang perlu diumumkan untuk jadwal hari ini');
                return Command::SUCCESS;
            }

            $this->info('Mulai mengumumkan ' . $pendaftarToAnnounce->count() . ' Pendaftar untuk tahun ajaran ' . $jadwal->thn_ajaran . ' gelombang ' . $jadwal->gelombang_pendaftaran . '...');

            foreach ($pendaftarToAnnounce as $pendaftar) {
                if ($pendaftar->siswa && $pendaftar->siswa->email_siswa) {
                    Mail::to($pendaftar->siswa->email_siswa)
                    ->send(new ResultNotificationMail($pendaftar));

                    $pendaftar->is_announced = true;
                    $pendaftar->save();
                    $this->info('Email pengumuman dikirim ke: ' . $pendaftar->siswa->email_siswa);
                } else {
                    $this->warn('Pendaftar dengan ID ' . $pendaftar->id . ' tidak memiliki email terdaftar. Melewati pengiriman email.');
                }
            }
        }

        $this->info('Pengiriman email pengumuman selesai.');
        return Command::SUCCESS;
    }
}
