<x-mail::message>
# Welcome to {{ config('app.name') }}!

Thank you for joining our newsletter.  
You will now receive updates about our programs, stories of impact, and upcoming events.

**Quick Links:**
- Our Programs → {{ url('/programs') }}
- Latest News → {{ url('/our-news') }}
- Get Involved → {{ url('/get-involved') }}

If you ever want to stop receiving emails, you can unsubscribe anytime.

[Unsubscribe from Newsletter]({{ $unsubscribeUrl }})

Warm regards,<br>
The {{ config('app.name') }} Team

<x-mail::subcopy>
You received this because you subscribed at {{ config('app.url') }}.
</x-mail::subcopy>
</x-mail::message>