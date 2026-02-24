<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;

class HeroSliderController extends Controller
{
    public function index()
    {
        return view('Admin.HeroSliders.Index');
    }

    public function create()
    {
        return view('Admin.HeroSliders.Create');
    }

    public function edit(HeroSlider $heroSlider)
    {
        return view('Admin.HeroSliders.Edit', compact('heroSlider'));
    }
}
