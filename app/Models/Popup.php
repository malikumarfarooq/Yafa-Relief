<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Popup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'button_text',
        'redirect_url',
        'is_active',
        'cooldown_hours',
        'display_order',
        'starts_at',
        'ends_at',
        'views_count',
        'clicks_count',
        'last_displayed_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'last_displayed_at' => 'datetime',
        'cooldown_hours' => 'integer',
        'display_order' => 'integer',
        'views_count' => 'integer',
        'clicks_count' => 'integer'
    ];

    /**
     * Scope to get active popups
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            })
            ->orderBy('display_order')
            ->latest();
    }

    /**
     * Increment views count
     */
    public function trackView()
    {
        $this->increment('views_count');
        $this->update(['last_displayed_at' => now()]);
    }

    /**
     * Increment clicks count
     */
    public function trackClick()
    {
        $this->increment('clicks_count');
    }

    /**
     * Check if popup should be shown based on cooldown
     */
    public function shouldBeShown($lastClosedAt = null)
    {
        if (!$lastClosedAt) {
            return true;
        }

        $cooldownMinutes = $this->cooldown_hours * 60;
        $lastClosed = \Carbon\Carbon::createFromTimestamp($lastClosedAt);

        return $lastClosed->addMinutes($cooldownMinutes)->isPast();
    }
}
