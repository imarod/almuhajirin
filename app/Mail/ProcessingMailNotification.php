<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\ManajemenJadwalPpdb; 

class ProcessingMailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;
    public $siswa;
    public $token;
     public $jadwal; 

    public function __construct(Pendaftaran $pendaftaran, Siswa $siswa, ManajemenJadwalPpdb $jadwal, $token)
    {
        $this->pendaftaran = $pendaftaran;
        $this->siswa = $siswa;
        $this->token = $token;
        $this->jadwal = $jadwal; 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status Pendaftaran Anda Telah Diproses',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pendaftaran-diproses',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
