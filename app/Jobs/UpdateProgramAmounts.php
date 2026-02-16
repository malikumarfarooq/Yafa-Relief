<?php

namespace App\Jobs;

use App\Models\Program;
use App\Models\DonationItem;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateProgramAmounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        // Get totals grouped by program_id (only paid donations)
        $totals = DonationItem::query()
            ->join('donations', 'donation_items.donation_id', '=', 'donations.id')
            ->where('donations.payment_status', 'paid')
            ->select(
                'donation_items.program_id',
                DB::raw('SUM(donation_items.subtotal) as total_amount'),
                DB::raw('COUNT(DISTINCT donations.email) as donors_count')
            )
            ->groupBy('donation_items.program_id')
            ->get()
            ->keyBy('program_id');

        // Update each program
        Program::chunk(100, function ($programs) use ($totals) {
            foreach ($programs as $program) {

                $data = $totals->get($program->id);

                $program->update([
                    'current_amount' => $data->total_amount ?? 0,
                    'donors_count'   => $data->donors_count ?? 0,
                    'is_complete'    => ($data && $data->total_amount >= $program->goal_amount),
                ]);
            }
        });
    }
}
