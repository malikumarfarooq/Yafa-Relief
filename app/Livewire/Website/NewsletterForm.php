<?php

namespace App\Livewire\Website;

use App\Models\Newsletter;
use App\Mail\Website\NewsletterSubscriptionConfirmation;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class NewsletterForm extends Component
{
    public string $email = '';
    public string $successMessage = '';
    public string $errorMessage = '';

    protected function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }

    protected function messages(): array
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email'    => 'Please enter a valid email address.',
        ];
    }

    public function subscribe(): void
    {
        // Reset messages first
        $this->successMessage = '';
        $this->errorMessage   = '';

        // Validate
        $this->validate();

        $email = strtolower(trim($this->email));

        $newsletter = Newsletter::where('email', $email)->first();

        // Already subscribed
        if ($newsletter && $newsletter->status === 'subscribed') {
            $this->errorMessage = 'You are already subscribed to our newsletter!';
            return;
        }

        // Re-subscribe
        if ($newsletter) {
            $newsletter->update([
                'status'          => 'subscribed',
                'subscribed_at'   => now(),
                'unsubscribed_at' => null,
            ]);
        } else {
            // New subscriber
            $newsletter = Newsletter::create([
                'email'         => $email,
                'status'        => 'subscribed',
                'subscribed_at' => now(),
            ]);
        }

        // Send email
        Mail::to($newsletter->email)
            ->queue(new NewsletterSubscriptionConfirmation($newsletter->email));

        // Clear the input
        $this->email = '';

        $this->successMessage = 'Thank you! You have been subscribed. Check your inbox!';
    }

    public function render()
    {
        return view('livewire.website.newsletter-form');
    }
}