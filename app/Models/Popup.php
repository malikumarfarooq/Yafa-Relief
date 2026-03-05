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
        'resource_type',
        'resource_id',
    ];
    protected $casts = [
        'is_active'      => 'boolean',
        'starts_at'      => 'datetime',
        'ends_at'        => 'datetime',
        'cooldown_hours' => 'integer',
        'display_order'  => 'integer',
    ];
    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('display_order')
            ->latest();
    }
    public function getCoverImageUrlAttribute(): string
    {
        if (
            $this->cover_image &&
            Storage::disk('public')->exists($this->cover_image)
        ) {
            return Storage::url($this->cover_image);
        }
        return asset('src/images/blog-detail-content-img.png');
    }
    public function getThumbnailUrlAttribute(): string
    {
        if (
            $this->thumbnail &&
            Storage::disk('public')->exists($this->thumbnail)
        ) {
            return Storage::url($this->thumbnail);
        }
        return asset('admin-assets/images/image.png');
    }
}
