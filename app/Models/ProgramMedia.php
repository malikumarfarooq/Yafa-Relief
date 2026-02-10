<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMedia extends Model
{
    protected $fillable = [
        'program_id',
        'type',
        'url',
        'order',
    ];
}
