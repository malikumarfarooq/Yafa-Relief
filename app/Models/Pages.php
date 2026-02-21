<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
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
    protected $table = 'pages';
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
    public function getReadingTimeAttribute()
{
    $wordCount = str_word_count(strip_tags($this->description));
    return ceil($wordCount / 200);
}
}
