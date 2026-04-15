<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Client $client,
        public Contact $contact,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Voxa Center — ' . __('Votre demande a ete enregistree'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-confirmation',
        );
    }
}
