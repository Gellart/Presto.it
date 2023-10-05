<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email,  $user_message, $phone;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $user_message, $phone)
    {
        $this->name=$name;    
        $this->email=$email;
        $this->user_message=$user_message;
        $this->phone=$phone;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('info@presto.it', 'Presto.it'),
            subject: 'Email form Contattaci',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contactadmin-mail',
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
