<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_url',
        'media_type',
        'media_path',
        'mobile_media_path',
        'order',
        'status',
    ];

    // Scope to get only active slides
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope to get slides in order
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
