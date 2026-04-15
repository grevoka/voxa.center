<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentRescheduled extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contact $contact,
        public string $oldDate,
        public string $oldSlot,
        public string $changedBy,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Voxa Center — ' . __('Votre rendez-vous a ete modifie'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment-rescheduled',
        );
    }
}
