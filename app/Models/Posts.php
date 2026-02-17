<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
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
    protected $table = 'posts';
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
