<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pendaftaran;
use App\Models\ManajemenJadwalPpdb;
use Carbon\Carbon;
use App\Jobs\SendWhatsappNotification;

class AnnouncePendaftaran extends Command
{
    protected $signature = 'pendaftaran:send-whatsapp';
    protected $description = 'Umumkan hasil pendaftaran dan kirim notifikasi WhatsApp hari ini';

    public function handle()
    {
        $jadwals = ManajemenJadwalPpdb::whereDate('tgl_pengumuman', Carbon::today())->get();

        if ($jadwals->isEmpty()) {
            $this->info('Tidak ada jadwal pengumuman hari ini');
            return Command::SUCCESS;
        }

        foreach ($jadwals as $jadwal) {
            $pendaftarToAnnounce = Pendaftaran::with('siswa.orangTua')
                ->where('jadwal_id', $jadwal->id)
                ->where('is_announced', false)
                ->get();

            if ($pendaftarToAnnounce->isEmpty()) {
                $this->info('Tidak ada pendaftar yang perlu diumumkan untuk jadwal hari ini');
                // return Command::SUCCESS;
            }

            $this->info('Mulai mengumumkan ' . $pendaftarToAnnounce->count() . ' Pendaftar untuk tahun ajaran ' . $jadwal->thn_ajaran . ' gelombang ' . $jadwal->gelombang_pendaftaran . '...');
            foreach ($pendaftarToAnnounce as $pendaftar) {
                SendWhatsappNotification::dispatch($pendaftar);
                $this->info("Job WhatsApp didispatch untuk ID Pendaftar: " . $pendaftar->id);
            }
        }

        $this->info('Pengumuman pendaftaran selesai.  Proses eksekusi akan dilanjutkan oleh Queue Worker.');
        return Command::SUCCESS;
    }

  
}
