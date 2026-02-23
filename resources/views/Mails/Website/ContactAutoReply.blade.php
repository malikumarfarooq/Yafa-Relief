<x-mail::message>
# Thank you, {{ $contactMessage->first_name }}!

We have received your message and our team will get back to you as soon as possible.

**Your Submission Details:**
- **Name:** {{ $contactMessage->first_name }} {{ $contactMessage->last_name }}
- **Email:** {{ $contactMessage->email }}
- **Subject:** {{ $contactMessage->subject ?? 'N/A' }}
- **Date:** {{ $contactMessage->created_at->format('M d, Y') }}

**Your Message:**

{{ $contactMessage->message }}

If you have any urgent concerns, feel free to reach us directly at {{ config('mail.from.address') }}.

Thanks,<br>
The {{ config('app.name') }} Team
</x-mail::message>