<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;

class UsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        // Logic to handle user management (list, create, edit users)
        return view('Admin.Settings.Users.Index');
    }

    public function create()
    {
        $roles = Role::all();

        return view('Admin.Settings.Users.Create', compact('roles'));
    }


    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('Admin.Settings.Users.Edit', ['user' => $user]);
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('Admin.Settings.Users.Show', ['user' => $user]);
    }
    public function destroy($userId)
    {
        $userService = new UserService();
        $deleted = $userService->deleteUser($userId);
        if (!$deleted) {
            return redirect()->back()->with('error', 'This user cannot be deleted.');
        }
        return redirect()->route('admin.settings.users.index')->with('success', 'User deleted successfully.');
    }
}
