<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __invoke()
    {
        return view('Admin.Settings.General');
    }

    public function integration()
    {
        return view('Admin.Settings.Integrations');
    }

    public function notifications()
    {
        return view('Admin.Settings.Notifications');
    }

    public function billing()
    {
        return view('Admin.Settings.Billing');
    }
}
