<?php

namespace App\Mail\Admin;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNewDonationNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Donation Received - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.admin.new-donation-notification',
            with: [
                'donation' => $this->donation,
            ],
        );
    }
}
