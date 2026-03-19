<?php

namespace App\Livewire\Website;

use App\Mail\Website\NewsletterSubscriptionConfirmation;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Services\TurnstileService;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';

    public string $successMessage = '';

    public string $errorMessage = '';
    public ?string $captchaToken = null;

    protected function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }

    protected function throttleKey(): string
    {
        return Str::lower(sprintf('newsletter|%s|%s', request()->ip(), $this->email ?: 'guest'));
    }

    protected function messages(): array
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }

    public function subscribe(TurnstileService $turnstile): void
    {
        // Reset messages first
        $this->successMessage = '';
        $this->errorMessage = '';

        if (! $turnstile->verify($this->captchaToken)) {
            $this->errorMessage = 'Please verify that you are not a robot.';
            return;
        }

        if (RateLimiter::tooManyAttempts($this->throttleKey(), 10)) {
            $seconds = RateLimiter::availableIn($this->throttleKey());
            $this->errorMessage = "Too many subscription attempts. Please try again in {$seconds} seconds.";

            return;
        }

        // Validate
        $this->validate();

        $email = strtolower(trim($this->email));

        RateLimiter::hit($this->throttleKey(), 300); // 10 attempts per 5 minutes

        $newsletter = Newsletter::where('email', $email)->first();

        // Already subscribed
        if ($newsletter && $newsletter->status === 'subscribed') {
            $this->errorMessage = 'You are already subscribed to our newsletter!';

            return;
        }

        // Re-subscribe
        if ($newsletter) {
            $newsletter->update([
                'status' => 'subscribed',
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ]);
        } else {
            // New subscriber
            $newsletter = Newsletter::create([
                'email' => $email,
                'status' => 'subscribed',
                'subscribed_at' => now(),
            ]);
        }

        // Send email (during local testing redirect to your inbox)
        $testTo = env('MAIL_TEST_TO');
        $redirectAll = app()->environment('local') && ! empty($testTo);

        $recipientEmail = $redirectAll ? $testTo : $newsletter->email;

        Mail::to($recipientEmail)
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
