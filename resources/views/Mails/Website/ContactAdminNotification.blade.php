<x-mail::message>
# New Contact Message Received

A new contact message has been submitted on {{ config('app.name') }}.

**Sender Details:**
- **Name:** {{ $contactMessage->first_name }} {{ $contactMessage->last_name }}
- **Email:** {{ $contactMessage->email }}
- **Phone:** {{ $contactMessage->phone ?? 'N/A' }}
- **Subject:** {{ $contactMessage->subject ?? 'N/A' }}
- **Received At:** {{ $contactMessage->created_at->format('M d, Y h:i A') }}

**Message:**

{{ $contactMessage->message }}

Thanks,<br>
{{ config('app.name') }} System
</x-mail::message>