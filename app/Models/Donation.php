<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Donation extends Model
{
    protected $fillable = [
        'donation_number',
        'year_sequence',
        'first_name',
        'last_name',
        'email',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_provider',
        'total_amount',
        'frequency',
    ];

    // ── Relationships ────────────────────────────────────────────────────────

    public function items()
    {
        return $this->hasMany(DonationItem::class);
    }

    // ── Auto-generate donation_number + year_sequence on create ──────────────

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($donation) {
            // Use now()->year (not date()->year — date() returns a string, not an object)
            $year = now()->year;

            // Lock the relevant rows to prevent a race condition when
            // two donations are created at the same moment.
            $lastSequence = static::whereYear('created_at', $year)
                ->lockForUpdate()
                ->max('year_sequence');

            $nextSequence = $lastSequence ? $lastSequence + 1 : 1;

            $donation->year_sequence   = $nextSequence;
            $donation->donation_number =
                'YR-' . $year . '-' . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
        });
    }
}