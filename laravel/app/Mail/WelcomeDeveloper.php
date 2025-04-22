<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use app\Models\apply_loker;


class WelcomeDeveloper extends Mailable
{
    use Queueable, SerializesModels;

    public $lamaran;
    public $pelamar;
    public $loker;
    /**
     * Create a new message instance.
     */
    public function __construct($pelamar)
    {
        $this->pelamar = $pelamar;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Developer',
        );
    }

    public function build()
    {
        // Subject dinamis berdasarkan status
        $subject = $this->pelamar->status === 'diterima'
            ? 'Selamat! Lamaran Anda Diterima'
            : 'Pemberitahuan: Lamaran Anda Ditolak';

        return $this->subject($subject)
            ->view('emails.emailtopelamar');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.emailtopelamar'
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
