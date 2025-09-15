<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pendaftaran;
use App\Models\ManajemenJadwalPpdb;
use App\Models\Siswa;
use Carbon\Carbon;
use illuminate\Support\Facades\App;
use Twilio\Rest\Client;

class AnnouncePendaftaran extends Command
{
    protected $signature = 'pendaftaran:announce';
    protected $description = 'Umumkan hasil pendaftaran dan kirim notifikasi WhatsApp hari ini';

    public function handle()
    {
        $jadwal = ManajemenJadwalPpdb::whereDate('tgl_pengumuman', Carbon::today())->first();

        if(!$jadwal) {
            $this->info('Tidak ada jadwal pengumuman hari ini');
            return Command::SUCCESS;
        }

        $pendaftarToAnnounce= Pendaftaran::with('siswa.orangTua')
        ->where('jadwal_id', $jadwal->id)
        ->where('is_announced', false)
        ->get();

        if($pendaftarToAnnounce->isEmpty()){
            $this->info('Tidak ada pendaftar yang perlu diumumkan untuk jadwal hari ini');
            return Command::SUCCESS;
        }

        $this->info('Mulai mengumumkan ' . $pendaftarToAnnounce->count() . 'Pendaftar untuk tahun ajaran '. $jadwal->thn_ajaran . 'gelombang' . $jadwal->gelombang_pendaftaran . '...');

        foreach($pendaftarToAnnounce as $pendaftar) {
            $this->sendWhatsAppNotification($pendaftar);
        }

          $this->info('Pengumuman pendaftaran selesai.');
        return Command::SUCCESS;
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
            $pendaftar->pesan_whatsapp = true; 
            $pendaftar->save();

        } catch (\Exception $e) {
            $this->error("Gagal mengirimkan notifikasi WhatsApp ke " . $pendaftar->siswa->no_hp_siswa . ": " . $e->getMessage()); 
            
        }
    }
}