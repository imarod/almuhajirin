<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pendaftaran;
use Illuminate\Support\Env;

class ResultNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct(Pendaftaran $pendaftaran, $token)
    {
        $this->pendaftaran = $pendaftaran;
        $this->token = $token;
    }
    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $status = $this->pendaftaran->status_aktual;
        $subject = ($status === 'Diterima') ? 'Selamat! Pendaftaran Anda Diterima' : 'Pendaftaran Anda Ditolak';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pengumuman_kelulusan',
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
