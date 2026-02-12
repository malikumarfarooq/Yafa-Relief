<x-mail::message>
# New Login Detected

Hello {{ $user->name }},

We detected a login to your account.

**Login Details:**

- 📅 Time: {{ $loginTime }}
- 🌍 IP Address: {{ $ip }}
- 💻 Device: {{ $userAgent }}

If this was you, no further action is required.

If you did NOT perform this login, please reset your password immediately.

<x-mail::button :url="url('/forgot-password')">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
