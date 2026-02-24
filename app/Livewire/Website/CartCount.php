<?php

namespace App\Livewire\Website;

use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{
    public $count = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cart-updated')]
    public function updateCount()
    {
        // Replace this with your actual cart logic (Session, Database, or Cart Package)
        // Example: $this->count = Cart::count();
        $this->count = session()->get('cart_count', 0);
    }

    public function render()
    {
        return view('livewire.website.cart-count');
    }
}
