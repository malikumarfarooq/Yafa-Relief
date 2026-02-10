<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'cover_image',
        'goal_amount',
        'current_amount',
        'min_amount',
        'amount_options',
        'donors_count',
        'promises',
        'legacy_message',
        'is_featured',
        'is_active',
        'is_urgent',
        'is_complete',
        'is_recurring_allowed',
        'start_date',
        'end_date',
        'associated_category_ids',
        'associated_attribute_ids',
    ];

    protected $casts = [
        'amount_options' => 'array',
        'promises' => 'array',
        'associated_category_ids' => 'array',
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'is_active' => 'boolean',
        'is_complete' => 'boolean',
        'is_recurring_allowed' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function daysRemaining()
    {
        if (!$this->end_date) {
            return null; // Ongoing program
        }
        $now = now();
        if ($now->greaterThan($this->end_date)) {
            return 0; // Program ended
        }
        return $now->diffInDays($this->end_date);
    }
    public function getCategoriesStringAttribute()
    {
        $categories = $this->associated_category_ids ? ProgramCategory::whereIn('id', $this->associated_category_ids)->get() : collect();
        if ($categories->isEmpty()) {
            return '';
        }
        return $categories->pluck('name')->implode(', ');
    }
    public function getAttributesArrayAttribute()
    {
        if (!$this->associated_attribute_ids) {
            return [];
        }
        return ProgramAttribute::whereIn('id', $this->associated_attribute_ids)->get();
    }
    public function media()
    {
        return $this->hasMany(ProgramMedia::class)->orderBy('order');
    }
}
