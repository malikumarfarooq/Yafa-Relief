<?php

namespace App\Providers;

use App\Models\Integration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class IntegrationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 1. Prevent errors during migrations or if DB isn't set up yet
        if (app()->runningInConsole() || ! Schema::hasTable('integrations')) {
            return;
        }

        // 2. Fetch all active integrations
        $integrations = Integration::where('is_active', true)->get();

        foreach ($integrations as $integration) {
            $this->applyConfig($integration);
        }
    }

    protected function applyConfig(Integration $integration)
    {
        $settings = $integration->settings;

        switch ($integration->provider) {
            case 'smtp':
                Config::set('mail.mailers.smtp.host', $settings['host'] ?? '');
                Config::set('mail.mailers.smtp.port', $settings['port'] ?? '');
                Config::set('mail.mailers.smtp.username', $settings['username'] ?? '');
                Config::set('mail.mailers.smtp.password', $settings['password'] ?? '');
                Config::set('mail.mailers.smtp.encryption', $settings['encryption'] ?? 'tls');
                break;

            case 'ses':
                Config::set('services.ses.key', $settings['key'] ?? '');
                Config::set('services.ses.secret', $settings['secret'] ?? '');
                Config::set('services.ses.region', $settings['region'] ?? 'us-east-1');
                Config::set('mail.default', 'ses');
                break;

            case 'stripe':
                Config::set('services.stripe.key', $settings['public_key'] ?? '');
                Config::set('services.stripe.secret', $settings['secret_key'] ?? '');
                Config::set('services.stripe.webhook.secret', $settings['webhook_secret'] ?? '');
                break;

                // Google/Meta don't usually have a 'config' file,
                // so we handle them in the Blade layout (see step 3)
        }
    }
}
