<?php

namespace App\Livewire\Website;

use App\Models\Donation;
use App\Services\StripeService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public $cart = [];

    public $first_name;

    public $last_name;

    public $email;

    public $payment_method = 'card';

    public $total = 0;

    public $frequencyLabel = '';

    public function mount()
    {
        $this->cart = session()->get('donation_cart', []);
        $this->calculateTotal();
        $this->resolveFrequencyLabel();
    }

    // ── Cart quantity / removal ──────────────────────────────────────────────

    public function increase($index)
    {
        $this->cart[$index]['quantity']++;
        $this->updateCart();
    }

    public function decrease($index)
    {
        if ($this->cart[$index]['quantity'] > 1) {
            $this->cart[$index]['quantity']--;
            $this->updateCart();
        }
    }

    public function remove($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);

        $this->updateCart();
    }

    // ── Private helpers ──────────────────────────────────────────────────────

    private function updateCart()
    {
        session()->put('donation_cart', $this->cart);
        $totalItems = count($this->cart);

        // 3. Store the single integer count in the session
        session()->put('cart_count', $totalItems);

        // 4. Dispatch the event (ensure this matches your Listener name exactly)
        $this->dispatch('cart-updated');
        $this->calculateTotal();
        $this->resolveFrequencyLabel();
    }

    private function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['amount'] * $item['quantity'];
        });
    }

    /**
     * Derive a human-readable frequency label from the first cart item.
     * Falls back to empty string when the cart is empty.
     */
    private function resolveFrequencyLabel()
    {
        if (empty($this->cart)) {
            $this->frequencyLabel = '';

            return;
        }

        $raw = $this->cart[0]['frequency'] ?? '';

        $this->frequencyLabel = match (strtolower($raw)) {
            'monthly' => 'Monthly',
            'yearly',
            'annual' => 'Yearly',
            'one-time',
            'one_time',
            'onetime' => 'One Time',
            default => ucfirst($raw),
        };
    }

    // ── Checkout ─────────────────────────────────────────────────────────────

    public function proceed()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|in:card,paypal,bank',
        ]);

        if (empty($this->cart)) {
            session()->flash('error', 'Your cart is empty.');

            return;
        }
        // Determine if this is a recurring donation
        $isRecurring = collect($this->cart)->contains(fn ($i) => $i['frequency'] !== 'one-time');
        DB::beginTransaction();

        try {
            // NOTE: year_sequence and donation_number are auto-generated
            // inside Donation::boot() — do NOT pass them manually here.
            $donation = Donation::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'payment_method' => $this->payment_method,
                'payment_status' => 'draft',
                'total_amount' => $this->total,
                'frequency' => $this->frequencyLabel,
            ]);

            foreach ($this->cart as $item) {
                $donation->items()->create([
                    'program_id' => $item['program_id'] ?? null,
                    'title' => $item['title'],
                    'amount' => $item['amount'],
                    'quantity' => $item['quantity'],
                    'frequency' => $item['frequency'],
                    'subtotal' => $item['amount'] * $item['quantity'],
                ]);
            }

            DB::commit();

            // Clear the cart after a successful order creation
            // session()->forget('donation_cart');
            session()->flash('error', 'Order Placed Successfully!');
            $stripeService = new StripeService;

            // Redirect based on chosen payment method
            return match ($this->payment_method) {
                'card' => $stripeService->createSession($donation, $isRecurring),
                'paypal' => redirect()->route('paypal.checkout', $donation->id),
                'bank' => redirect()->route('bank.instructions', $donation->id),
            };
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
        }
    }

    // ── Render ───────────────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.website.checkout');
    }
}
