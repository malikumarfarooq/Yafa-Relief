<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $ip;
    public $userAgent;
    public $loginTime;

    public function __construct(User $user, $ip, $userAgent)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->loginTime = now();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Login Detected on Your Account',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'Mails.Admin.LoginNotification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
