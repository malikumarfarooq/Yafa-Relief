<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('Admin.Profile.Index', ['user' => $user]);
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
