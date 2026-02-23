<?php

namespace App\Livewire\Website;

use App\Models\ContactMessage;
use App\Mail\Website\ContactAdminNotification;
use App\Mail\Website\ContactAutoReply;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public string $first_name = '';
    public string $last_name  = '';
    public string $email      = '';
    public string $phone      = '';
    public string $subject    = '';
    public string $message    = '';
    public string $successMessage = '';

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string|min:10',
        ];
    }

    protected function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'email.required'      => 'Email address is required.',
            'email.email'         => 'Please enter a valid email address.',
            'message.required'    => 'Message is required.',
            'message.min'         => 'Message must be at least 10 characters.',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $contactMessage = ContactMessage::create([
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'subject'    => $this->subject,
            'message'    => $this->message,
        ]);

        Mail::to(env('ADMIN_EMAIL'))->send(
            new ContactAdminNotification($contactMessage)
        );

        Mail::to($contactMessage->email)->send(
            new ContactAutoReply($contactMessage)
        );

        $this->reset([
            'first_name', 'last_name', 'email',
            'phone', 'subject', 'message'
        ]);

        $this->successMessage = 'Your message has been sent successfully! We will get back to you soon.';
    }

    public function render()
    {
        return view('livewire.website.contact-form');
    }
}