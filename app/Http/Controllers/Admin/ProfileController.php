<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('Admin.Profile.Index');
    }

    public function edit()
    {
        return view('Admin.Profile.Edit');
    }

    public function security()
    {
        return view('Admin.Profile.Security');
    }

    public function password()
    {
        return view('Admin.Profile.Password');
    }
}
