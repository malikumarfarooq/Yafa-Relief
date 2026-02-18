<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Integration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'provider',
        'type',
        'settings',
        'head_script',
        'body_script',
        'is_active',
        'last_synced_at',
    ];

    /**
     * The attributes that should be cast.
     * 'encrypted:json' handles security and array conversion in one go.
     */
    protected $casts = [
        'settings'       => 'encrypted:json', 
        'is_active'      => 'boolean',
        'last_synced_at' => 'datetime',
    ];

    /**
     * Scope: Only active integrations.
     * Usage: Integration::active()->get();
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope: Filter by type (tracking, payment, etc.)
     * Usage: Integration::ofType('tracking')->active()->get();
     */
    public function scopeOfType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    /**
     * Helper to get a specific setting with a default fallback.
     * Usage: $integration->getSetting('api_key', 'default_value');
     */
    public function getSetting(string $key, mixed $default = null): mixed
    {
        return data_get($this->settings, $key, $default);
    }

    /**
     * Check if the integration has valid scripts to inject.
     */
    public function hasScripts(): bool
    {
        return !empty($this->head_script) || !empty($this->body_script);
    }
}