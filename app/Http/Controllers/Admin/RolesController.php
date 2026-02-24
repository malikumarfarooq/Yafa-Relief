<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        // Logic to handle role management (list, create, edit roles)
        return view('Admin.Settings.Roles.Index');
    }

    public function create()
    {
        return view('Admin.Settings.Roles.Create');
    }

    public function edit($roleId)
    {
        $role = \Spatie\Permission\Models\Role::findById($roleId);
        if (! $role) {
            abort(404);
        }

        // Fetch role details using $roleId if necessary
        return view('Admin.Settings.Roles.Edit', ['role' => $role]);
    }
}
