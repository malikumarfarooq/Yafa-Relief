<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'avatar',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'category_id');
    }
}
