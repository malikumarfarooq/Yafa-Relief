<?php

namespace App\Mail\Website;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class NewsletterSubscriptionConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;

    public $unsubscribeUrl;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->unsubscribeUrl = URL::temporarySignedRoute(
            'newsletter.unsubscribe',
            now()->addDays(30),
            ['email' => $email]
        );
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Our Newsletter - Thank You for Subscribing!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'Mails.website.newsletter-confirmation',
        );
    }
}
