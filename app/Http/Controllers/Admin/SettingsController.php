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
}
