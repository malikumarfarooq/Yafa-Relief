<?php

namespace App\Mail\Website;

use App\Models\Donation; // Add this
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationReceivedNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $donation; // Public property makes it available to the view

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for your donation to '.config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'Mails.Website.DonationReceivedNotification',
        );
    }
}
