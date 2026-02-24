<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'cover_image',
        'is_active',
        'is_featured',
    ];

    protected $table = 'news';

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->description));

        return ceil($wordCount / 200);
    }

    public function getHighlightedTitleAttribute()
    {
        $words = explode(' ', $this->title);

        if (count($words) <= 1) {
            return $this->title;
        }

        // Pick random word
        $randomIndex = array_rand($words);

        $words[$randomIndex] = '<span>'.e($words[$randomIndex]).'</span>';

        return implode(' ', $words);
    }
}
