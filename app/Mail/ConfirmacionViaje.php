<?php

namespace App\Mail;

use App\Models\Viaje;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionViaje extends Mailable
{
    use Queueable, SerializesModels;

    public $viaje;
    public $pdfOutput;

    public function __construct(Viaje $viaje, $pdfOutput)
    {
        $this->viaje = $viaje;
        $this->pdfOutput = $pdfOutput;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu viaje ha sido confirmado - GlobalQuest',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.confirmacion',
            with: [
                'viaje' => $this->viaje,
                'user' => $this->viaje->user,
            ]
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfOutput, 'viaje_' . $this->viaje->id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}