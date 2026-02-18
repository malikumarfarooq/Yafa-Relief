<?php

namespace App\Livewire\Admin\Forms\Integration;

use App\Models\Integration;
use Livewire\Component;
use Illuminate\Support\Str;


class IntegrationForm extends Component
{
    // The active tab/provider being edited
    public $activeTab = 'stripe';

    // State for the currently selected integration
    public $name, $provider, $type, $is_active, $settings = [];
    public $head_script, $body_script;

    protected $config = [
        'stripe' => ['type' => 'payment',  'fields' => ['public_key', 'secret_key', 'webhook_secret']],
        'google' => ['type' => 'tracking', 'fields' => ['gtm_id', 'ads_id']],
        'meta'   => ['type' => 'tracking', 'fields' => ['pixel_id', 'access_token']],
        'ses'    => ['type' => 'email',    'fields' => ['key', 'secret', 'region']],
        'smtp'   => ['type' => 'email',    'fields' => ['host', 'port', 'username', 'password', 'encryption']],
    ];

    public function mount()
    {
        $this->loadTab($this->activeTab);
    }

    public function loadTab($provider)
    {
        $this->activeTab = $provider;
        
        // Find existing record or start fresh
        $integration = Integration::where('provider', $provider)->first();

        if ($integration) {
            $this->name        = $integration->name;
            $this->provider    = $integration->provider;
            $this->type        = $integration->type;
            $this->is_active   = $integration->is_active;
            $this->settings    = $integration->settings ?? [];
            $this->head_script = $integration->head_script;
            $this->body_script = $integration->body_script;
        } else {
            // Defaults for new provider
            $this->provider  = $provider;
            $this->name      = ucfirst($provider) . ' Integration';
            $this->type      = $this->config[$provider]['type'];
            $this->is_active = false;
            $this->settings  = array_fill_keys($this->config[$provider]['fields'], '');
            $this->head_script = null;
            $this->body_script = null;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'settings' => 'array'
        ]);

        Integration::updateOrCreate(
            ['provider' => $this->activeTab],
            [
                'name'        => $this->name,
                'slug'        => Str::slug($this->activeTab),
                'type'        => $this->type,
                'settings'    => $this->settings,
                'head_script' => $this->head_script,
                'body_script' => $this->body_script,
                'is_active'   => $this->is_active,
            ]
        );

        session()->flash('message', ucfirst($this->activeTab) . ' settings updated.');
    }

    public function render()
    {
        return view('livewire.admin.forms.integration.integration-form', [
            'config' => $this->config
        ]);
    }
}