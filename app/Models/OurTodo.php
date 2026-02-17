<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurTodo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    protected $table = 'what_we_do';
}
