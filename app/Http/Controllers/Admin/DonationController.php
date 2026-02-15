<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index(){
        return view('Admin.Donations.Index');
    }
    public function show($donationNumber){
        $donation = Donation::where('donation_number', $donationNumber)->first();
        return view('Admin.Donations.Show', ['donation' => $donation]);
    }

    public function donors(){
        return view('Admin.Donations.Donors.Index');
    }
    
public function donorDetails($donorEmail)
{
    $donations = Donation::where('email', $donorEmail)
        ->orderByDesc('created_at')
        ->paginate(20);

    $totalDonations = Donation::where('email', $donorEmail)->count();
    $totalAmount = Donation::where('email', $donorEmail)->sum('total_amount');

    return view('Admin.Donations.Donors.Show', [
        'donations'      => $donations,
        'email'          => $donorEmail,
        'totalDonations' => $totalDonations,
        'totalAmount'    => $totalAmount,
    ]);
}

}
