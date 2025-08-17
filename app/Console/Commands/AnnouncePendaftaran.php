<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pendaftaran;
use App\Models\ManajemenJadwalPpdb;
use Carbon\Carbon;
use illuminate\Support\Facades\App;
use Twilio\Rest\Client;

class AnnouncePendaftaran extends Command
{
    protected $signature = 'pendaftaran:announce';
    protected $description = 'Umumkan hasil pendaftaran dan kirim notifikasi WhatsApp hari ini';

    public function handle()
    {
        $jadwal = ManajemenJadwalPpdb::first();

        if(!$jadwal || !$jadwal->tgl_pengumuman) {
            $this->info('Tanggal pengumuman belum diatur');
            return Command::SUCCESS;
        }

        $tglPengumuman = \Carbon\Carbon::parse($jadwal->tgl_pengumuman);

        if(!$tglPengumuman->isToday()) {
            $this->info('Hari ini bukan tanggal pengumuman');
            return Command::SUCCESS;
        }

        $pendaftarToAnnounce = Pendaftaran::with('siswa.orangTua')
            ->where('is_announced', false)
            ->get();

            if($pendaftarToAnnounce->isEmpty()){
                $this->info('Tidak ada pendaftar yang perlu diumumkan hari ini');
                return Command::SUCCESS;
            }

            $this->info('Mulai mengumumkan ' . $pendaftarToAnnounce->count() . ' pendaftar...');    

            foreach($pendaftarToAnnounce as $pendaftar) {
                $this->sendWhatsAppNotification($pendaftar);
                $this->info('Pengumuman pendaftaran selesai');
                return Command::SUCCESS;
            }
        // $today = Carbon::today();
        // $pendaftarToAnnounce = Pendaftaran::with('siswa.orangTua')
        //     ->whereDate('tgl_pengumuman', $today)
        //     ->where('is_announced', false)
        //     ->get();

        // if ($pendaftarToAnnounce->isEmpty()) {
        //     $this->info('Tidak ada pengumuman pendaftaran untuk hari ini');
        //     return Command::SUCCESS;
        // }

        // $this->info('Mulai mengumumkan ' . $pendaftarToAnnounce->count() . ' pendaftar...');

        // foreach ($pendaftarToAnnounce as $pendaftar) {
        //     // Panggil method pengiriman notifikasi
        //     $this->sendWhatsAppNotification($pendaftar);
        // }

        // $this->info('Pengumuman pendaftaran selesai.');
        // return Command::SUCCESS;
    }

    private function sendWhatsAppNotification($pendaftar)
    {
        $sid = env("TWILIO_SID");
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_whatsapp_number = env("TWILIO_WHATSAPP_FROM");

        $to = 'whatsapp:' . $pendaftar->siswa->no_hp_siswa;
        $message = "Halo *{$pendaftar->siswa->nama}*, \n\nKami informasikan hasil pendaftaran siswa baru untuk ananda *{$pendaftar->siswa->nama}* adalah: *{$pendaftar->status_aktual}*. \n\nSilakan cek dashboard Anda untuk mengecek status pendaftaran. \n\nTerima kasih.";
        
        try {
            $twilio = new Client($sid, $token);
            
            $twilio->messages->create($to, [
                "from" => "whatsapp:" . $twilio_whatsapp_number,
                "body" => $message,
            ]);

            $this->info("Notifikasi WhatsApp berhasil dikirim ke " . $pendaftar->siswa->no_hp_siswa);

            // Ubah is_announced menjadi true HANYA JIKA notifikasi berhasil dikirim
            $pendaftar->is_announced = true;
            $pendaftar->pesan_whatsapp = true; // Baris ini juga dipindahkan ke sini
            $pendaftar->save();

        } catch (\Exception $e) {
            $this->error("Gagal mengirimkan notifikasi WhatsApp ke " . $pendaftar->siswa->no_hp_siswa . ": " . $e->getMessage()); 
            
        }
    }
}