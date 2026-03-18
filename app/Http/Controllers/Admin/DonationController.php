<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return view('Admin.Donations.Index');
    }

    public function analytics()
    {
        $totalDonations = Donation::count();
        $totalPaidAmount = Donation::where('payment_status', 'paid')->sum('total_amount');
        $totalPendingAmount = Donation::where('payment_status', 'pending')->sum('total_amount');

        $today = now()->startOfDay();
        $thisMonthStart = now()->startOfMonth();

        $todayDonations = Donation::whereDate('created_at', $today)->count();
        $thisMonthDonations = Donation::where('created_at', '>=', $thisMonthStart)->count();

        $averageDonation = Donation::where('payment_status', 'paid')->avg('total_amount');

        $topPrograms = DonationItem::select(
            'program_id',
            'title',
            DB::raw('COUNT(*) as donations_count'),
            DB::raw('SUM(subtotal) as total_raised')
        )
            ->groupBy('program_id', 'title')
            ->orderByDesc('total_raised')
            ->limit(5)
            ->get();

        return view('Admin.Donations.Analytics', [
            'totalDonations' => $totalDonations,
            'totalPaidAmount' => $totalPaidAmount,
            'totalPendingAmount' => $totalPendingAmount,
            'todayDonations' => $todayDonations,
            'thisMonthDonations' => $thisMonthDonations,
            'averageDonation' => $averageDonation,
            'topPrograms' => $topPrograms,
        ]);
    }

    public function reports(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $baseQuery = Donation::query();

        if ($from) {
            $baseQuery->whereDate('created_at', '>=', $from);
        }

        if ($to) {
            $baseQuery->whereDate('created_at', '<=', $to);
        }

        $totalDonations = (clone $baseQuery)->count();
        $totalAmount = (clone $baseQuery)->where('payment_status', 'paid')->sum('total_amount');

        $byStatus = (clone $baseQuery)->select(
            'payment_status',
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(total_amount) as total_amount')
        )
            ->groupBy('payment_status')
            ->orderBy('payment_status')
            ->get();

        $last7DaysQuery = (clone $baseQuery)->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(total_amount) as total_amount')
        );

        // Default last 7 days if no custom range is provided
        if (! $from && ! $to) {
            $last7DaysQuery->where('created_at', '>=', now()->subDays(6)->startOfDay());
        }

        $last7Days = $last7DaysQuery
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        return view('Admin.Donations.Reports', [
            'totalDonations' => $totalDonations,
            'totalAmount' => $totalAmount,
            'byStatus' => $byStatus,
            'last7Days' => $last7Days,
            'from' => $from,
            'to' => $to,
        ]);
    }

    public function show($donationNumber)
    {
        $donation = Donation::where('donation_number', $donationNumber)->first();

        return view('Admin.Donations.Show', ['donation' => $donation]);
    }

    public function donors()
    {
        return view('Admin.Donations.Donors.Index');
    }

    public function donorDetails($donorEmail)
    {

        $donations = Donation::where('email', $donorEmail)
            ->orderByDesc('created_at')
            ->paginate(20);
        $totalDonations = Donation::where('email', $donorEmail)->count();

        $totalAmount = Donation::where('email', $donorEmail)->where('payment_status', 'paid')->sum('total_amount');

        return view('Admin.Donations.Donors.Show', [
            'donations' => $donations,
            'email' => $donorEmail,
            'totalDonations' => $totalDonations,
            'totalAmount' => $totalAmount,
        ]);
    }
}
