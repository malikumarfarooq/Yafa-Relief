<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationItem extends Model
{
    protected $fillable = [
        'donation_id',
        'program_id',
        'title',
        'amount',
        'quantity',
        'frequency',
        'subtotal',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
