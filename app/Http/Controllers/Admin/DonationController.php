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

}
