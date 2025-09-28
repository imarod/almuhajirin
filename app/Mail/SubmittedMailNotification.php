<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pendaftaran;
use App\Models\Siswa;

class SubmittedMailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $pendaftaran;
    public $siswa;
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
            subject: 'Konfirmasi Pendaftaran Berhasil Terkirim',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pendaftaran-dikirim',
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
