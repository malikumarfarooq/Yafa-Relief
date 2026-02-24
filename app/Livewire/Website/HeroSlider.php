<?php

namespace App\Livewire\Website;

use App\Models\HeroSlider as HeroSliderModel;
use Livewire\Component;

class HeroSlider extends Component
{
    public function render()
    {
        $slides = HeroSliderModel::active()
            ->ordered()
            ->get();

        return view('livewire.website.hero-slider', [
            'slides' => $slides,
        ]);
    }
}
