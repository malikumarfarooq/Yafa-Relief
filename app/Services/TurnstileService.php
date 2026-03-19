<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TurnstileService
{
    public function verify(?string $token): bool
    {
        $secret = config('services.turnstile.secret');
        $isLocal = app()->environment('local');

        if ($isLocal && Str::startsWith((string) $secret, '1x0000')) {
            // Allow local testing with Turnstile test credentials.
            return true;
        }

        if (! $token) {
            return false;
        }

        if (! $secret) {
            // If not configured, fail closed in production, but allow in local
            return $isLocal;
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret'   => $secret,
            'response' => $token,
            'remoteip' => request()->ip(),
        ]);

        if (! $response->ok()) {
            return false;
        }

        return (bool)($response->json('success') ?? false);
    }
}

