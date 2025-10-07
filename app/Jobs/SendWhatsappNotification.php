<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Pendaftaran;
use Twilio\Rest\Client;

class SendWhatsappNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels, Queueable;

    protected $pendaftar;

    public function __construct(Pendaftaran $pendaftar)
    {
        $this->pendaftar = $pendaftar->loadMissing('siswa.OrangTua');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pendaftar = $this->pendaftar;

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

            $pendaftar->pesan_whatsapp = true;
            if ($pendaftar->pesan_email) { 
                $pendaftar->is_announced = true;
            }
            $pendaftar->save();
            sleep(1); 

            \Log::info("Notifikasi WhatsApp berhasil dikirim ke " . $pendaftar->siswa->no_hp_siswa);

        } catch (\Exception $e) {
            // Log kegagalan
            \Log::error("Gagal mengirimkan notifikasi WhatsApp ke " . $pendaftar->siswa->no_hp_siswa . ": " . $e->getMessage());
            
            // retry job
             throw $e; 
        }
      
    }
}
