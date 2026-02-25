<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Popup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'cover_image',
        'thumbnail',
        'button_text',
        'redirect_url',
        'is_active',
        'cooldown_hours',
        'display_order',
        'starts_at',
        'ends_at',
        'views_count',
        'clicks_count',
        'last_displayed_at',
        'resource_type',
        'resource_id'
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
     * Get the cover image URL
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image && Storage::disk('public')->exists($this->cover_image)) {
            return Storage::url($this->cover_image);
        }
        return asset('admin-assets/images/image.png');
    }

    /**
     * Get the thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail && Storage::disk('public')->exists($this->thumbnail)) {
            return Storage::url($this->thumbnail);
        }
        return asset('admin-assets/images/image.png');
    }

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

    /**
     * Get the linked resource (program or resource)
     */
    public function linkedResource()
    {
        if ($this->resource_type === 'program') {
            return $this->belongsTo(Program::class, 'resource_id');
        } elseif ($this->resource_type === 'resource') {
            return $this->belongsTo(Resource::class, 'resource_id');
        }
        return null;
    }
}
