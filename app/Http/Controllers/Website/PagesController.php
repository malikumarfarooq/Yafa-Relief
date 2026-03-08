<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        $latestNews = \App\Models\News::where('is_active', 1)->limit(3)->orderBy('created_at', 'desc')->get();
        $urgentPrograms = \App\Models\Program::where('is_active', 1)->where('is_urgent', 1)->limit(6)->get();
        $featuredPrograms = \App\Models\Program::where('is_active', 1)->where('is_featured', 1)->limit(4)->orderBy('created_at', 'desc')->get();

        return view('Website.Home', compact('urgentPrograms', 'featuredPrograms', 'latestNews'));
    }

    public function programs()
    {
        $programs = \App\Models\Program::where('is_active', 1)->get();

        return view('Website.Programs', compact('programs'));
    }

    public function programDetails($programPermalink)
    {
        $todos = \App\Models\OurTodo::limit(3)->inRandomOrder()->get();
        $program = \App\Models\Program::where('slug', $programPermalink)->where('is_active', 1)->first();
        $randomPrograms = \App\Models\Program::where('is_active', 1)->inRandomOrder()->limit(2)->get();
        if (! $program) {
            abort(404);
        }

        return view('Website.ProgramDetails', compact('program', 'randomPrograms', 'todos'));
    }

    public function about()
    {
        return view('website.about');
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


    public function ourpolicies()
    {
        return view('website.ourpolicies');
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

    public function ourNews()
    {
        $news = \App\Models\News::where('is_active', 1)->orderBy('created_at', 'desc')->get();

        return view('Website.OurNews', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = \App\Models\News::where('slug', $slug)->where('is_active', 1)->first();
        if (! $news) {
            abort(404);
        }
        $relatedNews = \App\Models\News::where('is_active', 1)->inRandomOrder()->limit(5)->get();

        return view('Website.NewsDetail', compact('news', 'relatedNews'));
    }

    // Stories listing
    public function ourStories()
    {
        $stories = \App\Models\Stories::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Website.OurStories', compact('stories'));
    }

    public function storiesDetail($slug)
    {

        // dd("Method storiesDetail called! Slug received: " . $slug);
        $story = \App\Models\Stories::where('slug', $slug)
            ->where('is_active', 1)
            ->first();

        if (! $story) {
            abort(404);
        }

        $relatedStories = \App\Models\Stories::where('is_active', 1)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('Website.StoryDetail', compact('story', 'relatedStories'));
    }

    public function ourBlogs()
    {
        $blogs = \App\Models\Posts::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Website.OurBlogs', compact('blogs'));
    }

    // Display a single Blog detail page

    public function blogsDetail($slug)
    {
        $blog = \App\Models\Posts::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        $relatedBlogs = \App\Models\Posts::where('is_active', 1)
            ->where('id', '!=', $blog->id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('Website.BlogDetail', compact('blog', 'relatedBlogs'));
    }

    public function pageDetail($slug)
    {
        $page = \App\Models\Pages::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        return view('Website.PageDetail', compact('page'));
    }
}
