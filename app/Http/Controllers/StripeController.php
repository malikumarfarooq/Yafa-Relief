<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Stripe\StripeClient;
use App\Mail\Website\DonationReceivedNotification;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function successStripeCheckout(Request $request)
    {
        $sessionId = $request->query('session_id');
        $donationId = $request->query('donation_id');

        if (!$sessionId || !$donationId) {
            return redirect()->route('website.checkout')->with('error', 'Invalid session data.');
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        try {
            // Fetch the session from Stripe to verify status
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            $transactionId = $session->payment_intent ?? $session->id;
            if ($session->payment_status === 'paid') {
                // 1. Update Donation Status
                $donation = Donation::findOrFail($donationId);

                // Prevent double-processing if the user refreshes the page
                if ($donation->payment_status !== 'paid') {
                    // 1. Single database query to update all fields
                    $donation->update([
                        'payment_status'   => 'paid',
                        'transaction_id'   => $transactionId,
                        'payment_provider' => 'stripe',
                    ]);
Mail::to($donation->email)->send(new DonationReceivedNotification($donation->load('items')));
                    // 2. Clear session data efficiently
                    session()->forget(['cart_count', 'donation_cart']);
                }
                return redirect()->route('website.thank-you')->with('success', 'Thank you for your donation - your donation has been received, and donation number: ' . $donation->donation_number)->with('donation', $donation);
            }

            return redirect()->route('website.checkout')->with('error', 'Payment was not successful.');
        } catch (\Exception $e) {
            return redirect()->route('website.checkout')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function stripeCheckoutCancel()
    {
        return redirect()->route('website.checkout')->with('error', 'Payment was cancelled.');
    }
}
