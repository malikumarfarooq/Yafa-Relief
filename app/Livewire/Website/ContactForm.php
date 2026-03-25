<?php

namespace App\Livewire\Website;

use App\Mail\Website\ContactAdminNotification;
use App\Mail\Website\ContactAutoReply;
use App\Models\ContactMessage;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Services\TurnstileService;
use Livewire\Component;

class ContactForm extends Component
{
    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $phone = '';

    public string $subject = '';

    public string $message = '';

    public string $successMessage = '';

    public ?string $captchaToken = null;

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ];
    }

    protected function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters.',
        ];
    }

    protected function throttleKey(): string
    {
        return Str::lower(sprintf('contact|%s|%s', request()->ip(), $this->email ?: 'guest'));
    }

    public function submit(TurnstileService $turnstile): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            $seconds = RateLimiter::availableIn($this->throttleKey());
            $this->addError('rate_limit', "Too many messages. Please try again in {$seconds} seconds.");

            return;
        }

        $this->validate();

        if (! $turnstile->verify($this->captchaToken)) {
            $this->addError('captcha', 'Please verify that you are not a robot.');

            return;
        }

        RateLimiter::hit($this->throttleKey(), 60);

        $contactMessage = ContactMessage::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $testTo = env('MAIL_TEST_TO');
        $redirectAll = app()->environment('local') && ! empty($testTo);

        $adminEmail = SystemSetting::getValue('admin_email', null)
            ?? config('mail.admin_email')
            ?? config('mail.from.address');

        $adminRecipient = $redirectAll ? $testTo : $adminEmail;
        $clientRecipient = $redirectAll ? $testTo : $contactMessage->email;

        // SETTINGS CHECK: Respects admin toggle from Settings > Notifications
        // To test: Set notification_contact_message = false in system_settings
        // table and confirm no admin notification email is sent after contact form submission.
        if (SystemSetting::getValue('notification_contact_message', true)) {
            Mail::to($adminRecipient)->send(
                new ContactAdminNotification($contactMessage)
            );
        }

        // SETTINGS CHECK: Respects admin toggle from Settings > Notifications
        // To test: Set notification_contact_message = false in system_settings
        // table and confirm no auto-reply email is sent to user after contact form submission.
        if (SystemSetting::getValue('notification_contact_message', true)) {
            Mail::to($clientRecipient)->send(
                new ContactAutoReply($contactMessage)
            );
        }

        $this->reset([
            'first_name',
            'last_name',
            'email',
            'phone',
            'subject',
            'message',
        ]);

        $this->successMessage = 'Your message has been sent successfully! We will get back to you soon.';
    }

    public function render()
    {
        return view('livewire.website.contact-form');
    }
}
