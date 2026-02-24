<?php

namespace App\Services;

use App\Models\Donation;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeService
{
    public function createSession(Donation $donation, bool $isSubscription = false)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $mode = $isSubscription ? 'subscription' : 'payment';

        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => $mode,
            'line_items' => $this->buildLineItems($donation, $isSubscription),
            'customer_email' => $donation->email,
            'metadata' => ['donation_id' => $donation->id], // Essential for Webhooks
            'success_url' => route('stripe.success').'?session_id={CHECKOUT_SESSION_ID}&success=true&donation_id='.$donation->id,
            'cancel_url' => route('stripe.cancel').'?session_id={CHECKOUT_SESSION_ID}&success=false',
        ]);

        return redirect($session->url);
    }

    private function buildLineItems(Donation $donation, $isSubscription)
    {
        return $donation->items->map(function ($item) use ($isSubscription) {
            $data = [
                'price_data' => [
                    'currency' => config('app.currency', 'usd'),
                    'unit_amount' => (int) ($item->amount * 100),
                    'product_data' => ['name' => $item->title],
                ],
                'quantity' => $item->quantity,
            ];

            if ($isSubscription) {
                $data['price_data']['recurring'] = [
                    'interval' => $this->mapFrequency($item->frequency),
                ];
            }

            return $data;
        })->toArray();
    }

    private function mapFrequency($frequency): string
    {
        return match (strtolower($frequency)) {
            'daily' => 'day',
            'weekly' => 'week',
            'monthly' => 'month',
            'yearly', 'annual' => 'year',
            default => 'month', // Default fallback
        };
    }
}
