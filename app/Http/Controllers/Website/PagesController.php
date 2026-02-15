<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $urgentPrograms = \App\Models\Program::where('is_active', 1)->where('is_urgent', 1)->limit(6)->get();
        $featuredPrograms = \App\Models\Program::where('is_active', 1)->where('is_featured', 1)->limit(4)->orderBy('created_at', 'desc')->get();
        return view('Website.Home', compact('urgentPrograms', 'featuredPrograms'));
    }
    public function programs()
    {
        $programs = \App\Models\Program::where('is_active', 1)->get();
        return view('Website.Programs', compact('programs'));
    }
    public function programDetails($programPermalink)
    {
        $program = \App\Models\Program::where('slug', $programPermalink)->where('is_active', 1)->first();
        $randomPrograms = \App\Models\Program::where('is_active', 1)->inRandomOrder()->limit(2)->get();
        if (!$program) {
            abort(404);
        }
        return view('Website.ProgramDetails', compact('program', 'randomPrograms'));
    }
    public function about()
    {
        return view('Website.About');
    }
    public function contact()
    {
        return view('Website.ContactUs');
    }
    public function getInvolved()
    {
        return view('Website.GetInvolved');
    }
    public function resources()
    {
        return view('Website.Resources');
    }
    public function donate()
    {
        return view('Website.Donate');
    }
    public function checkout()
    {
        return view('Website.Checkout');
    }
    public function thankYou()
    {
        return view('Website.ThankYou');
    }
}
