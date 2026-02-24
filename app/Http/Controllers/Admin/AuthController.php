<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login()
    {
        return view('Admin.Auth.Login');
    }

    public function logout(AuthService $authService)
    {
        $authService->logout();

        return redirect()->route('admin.login');
    }

    public function forgotPassword()
    {
        return view('Admin.Auth.ForgotPassword');
    }

    public function resetPassword($token)
    {
        return view('Admin.Auth.ResetPassword', ['token' => $token]);
    }
}
