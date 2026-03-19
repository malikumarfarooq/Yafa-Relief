<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TurnstileService
{
    public function verify(?string $token): bool
    {
        if (! $token) {
            return false;
        }

        $secret = config('services.turnstile.secret');

        if (! $secret) {
            // If not configured, fail closed in production, but allow in local
            return app()->environment('local') ? true : false;
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

