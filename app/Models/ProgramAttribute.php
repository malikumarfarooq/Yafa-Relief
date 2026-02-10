<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramAttribute extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'avatar',
    ];
}
