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

    public function mount(Program $program)
    {
        $this->program = $program;
        //empty cart on program details page load for testing
        //session()->forget('donation_cart');

        // Auto-select the first option from your [10, 20, 30] array
        if (!empty($this->program->amount_options)) {
            $this->amount = $this->program->amount_options[0];
        }
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
            'frequency' => 'required|in:one-time,daily,weekly,monthly',
        ]);

        $cart = session()->get('donation_cart', []);

        $found = false;

        foreach ($cart as &$item) {
            if (
                $item['program_id'] == $this->program->id &&
                $item['amount'] == $finalAmount &&
                $item['frequency'] == $this->frequency
            ) {
                // Same item → increase quantity
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'program_id' => $this->program->id,
                'program_details' => $this->program->toArray(),
                'title' => $this->program->title,
                'amount' => $finalAmount,
                'frequency' => $this->frequency,
                'quantity' => 1, // hidden from UI
            ];
        }

        session()->put('donation_cart', $cart);

        $this->dispatch('cart-updated');
        session()->flash('success', 'Donation added to cart!');
    }

    public function render()
    {
        return view('livewire.website.add-to-cart');
    }
}
