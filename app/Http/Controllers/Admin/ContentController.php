<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function postIndex()
    {
        return view('Admin.Content.Posts.Index');
    }
    public function postcCreate()
    {
        return view('Admin.Content.Posts.Create');
    }
    public function postEdit($id)
    {
        $post = \App\Models\Posts::findOrFail($id);
        if (!$post) {
            abort(404);
        }
        return view('Admin.Content.Posts.Edit', compact('post'));
    }
    public function pagesIndex()
    {
        return view('Admin.Content.Pages.Index');
    }
    public function pagesCreate()
    {
        return view('Admin.Content.Pages.Create');
    }
    public function pagesEdit($id)
    {
        $page = \App\Models\Pages::findOrFail($id);
        if (!$page) {
            abort(404);
        }
        return view('Admin.Content.Pages.Edit', compact('page'));
    }
    public function storiesIndex() {
        return view('Admin.Content.Stories.Index');
    }
    public function storiesCreate() {
        return view('Admin.Content.Stories.Create');
    }
    public function storiesEdit($id) {
        $story = \App\Models\Stories::findOrFail($id);
        if (!$story) {
            abort(404);
        }
        return view('Admin.Content.Stories.Edit', compact('story'));

    }
    public function newsIndex() {
        return view('Admin.Content.News.Index');
    }
    public function newsCreate() {
        return view('Admin.Content.News.Create');
    }
    public function newsEdit($id) {
        $news = \App\Models\News::findOrFail($id);
        if (!$news) {
            abort(404);
        }
        return view('Admin.Content.News.Edit', compact('news'));
    }
}
