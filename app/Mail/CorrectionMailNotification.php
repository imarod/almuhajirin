<?php

namespace App\Mail;

use App\Models\Pendaftaran;
use App\Models\Siswa; 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class CorrectionMailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;
    public $siswa;
    public $token;
    
    public function __construct(Pendaftaran $pendaftaran, Siswa $siswa, $token)
    {
        $this->pendaftaran = $pendaftaran;
        $this->siswa = $siswa;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Perbaikan Formulir Pendaftaran',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.perbaikan-pendaftaran',
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
