<?php

namespace App\Mail\Admin;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Password Has Been Reset Successfully',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'Mails.Admin.PasswordResetNotification',
            with: [
                'userName' => $this->user->f_name.' '.$this->user->l_name,
                'email' => $this->user->email,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
