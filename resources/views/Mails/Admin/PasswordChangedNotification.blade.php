<x-mail::message>
# Password Changed Successfully

Hello {{ $userName }},

This is a confirmation that your account password has been changed.

If you performed this action, no further steps are required.

If you did **not** changed your password, please contact our support team immediately.

<x-mail::button :url="route('admin.login')">
Login to Your Account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
