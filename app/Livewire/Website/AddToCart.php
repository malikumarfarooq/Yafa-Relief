<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Models\Program;

class AddToCart extends Component
{
    public Program $program;

    // State
    public $amount;
    public $customAmount;
    public $frequency = 'one-time'; // Default
    public $is_recurring = false;
    public $minAmount = 0;


    public function mount(Program $program)
    {
        $this->program = $program;
        //empty cart on program details page load for testing
        //session()->forget('donation_cart');

        // Auto-select the first option from your [10, 20, 30] array
        if (!empty($this->program->amount_options)) {
            $this->amount = $this->program->amount_options[0];
        }

        $this->is_recurring = $this->program->is_recurring_allowed;
        $this->minAmount = $this->program->min_amount ?? 0;
    }

    public function setAmount($value)
    {
        $this->amount = $value;
        $this->customAmount = null;
    }

    public function updatedCustomAmount($value)
    {
        if ($value) {
            
            $this->amount = null;
        }
    }

    public function addToCart()
    {
        $finalAmount = $this->customAmount ?: $this->amount;

        $this->validate([
            'amount' => 'required_without:customAmount',
            'customAmount' => 'nullable|numeric|min:1',
            'frequency' => 'required|in:one-time,daily,weekly,monthly,yearly',
        ]);

        $cart = session()->get('donation_cart', []);
        $cartCollection = collect($cart);

        // 1. Check for One-Time vs Recurring mix (Existing logic)
        $hasRecurring = $cartCollection->contains(fn($item) => $item['frequency'] !== 'one-time');
        $hasOneTime = $cartCollection->contains(fn($item) => $item['frequency'] === 'one-time');

        if ($hasRecurring && $this->frequency === 'one-time') {
            session()->flash('error', 'You cannot mix one-time and recurring donations.');
            return;
        }

        if ($hasOneTime && $this->frequency !== 'one-time') {
            session()->flash('error', 'You cannot mix recurring and one-time donations.');
            return;
        }

        // 2. 🔒 NEW: Interval Consistency Check (The Stripe Fix)
        // If adding a recurring donation, it must match the frequency of existing items
        if ($this->frequency !== 'one-time' && $hasRecurring) {
            $existingFrequency = $cartCollection->first(fn($item) => $item['frequency'] !== 'one-time')['frequency'];

            if ($existingFrequency !== $this->frequency) {
                session()->flash('error', "Your cart already contains a {$existingFrequency} donation. Stripe requires all items in one checkout to have the same billing cycle.");
                return;
            }
        }

        // 3. Normal add/update logic
        $found = false;
        foreach ($cart as &$item) {
            if (
                $item['program_id'] == $this->program->id &&
                $item['amount'] == $finalAmount &&
                $item['frequency'] == $this->frequency
            ) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'program_id' => $this->program->id,
                'title'      => $this->program->title,
                'amount'     => $finalAmount,
                'frequency'  => $this->frequency,
                'quantity'   => 1,
            ];
        }

        // 1. Save the actual cart data
        session()->put('donation_cart', $cart);

        // 2. Calculate the actual number of items
        // Use count() for total unique entries, or array_sum() if your cart stores quantities
        $totalItems = count($cart);

        // 3. Store the single integer count in the session
        session()->put('cart_count', $totalItems);

        // 4. Dispatch the event (ensure this matches your Listener name exactly)
        $this->dispatch('cart-updated');

        // 5. Success message
        session()->flash('success', 'Donation added to cart!');
    }

    public function render()
    {
        return view('livewire.website.add-to-cart');
    }
}
