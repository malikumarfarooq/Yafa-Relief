<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\LoginNotification;
use App\Mail\Admin\PasswordResetNotification;
use App\Mail\Admin\PasswordChangedNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

class AuthService
{

    public function authenticate($email, $password, $remember = false)
    {
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user || !$user->is_active || $user->user_type !== 'admin') {
            return false;
        }

        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ], $remember)) {

            // Send login notification
            Mail::to($user->email)->send(
                new LoginNotification(
                    $user,
                    request()->ip(),
                    request()->userAgent()
                )
            );

            return true;
        }

        return false;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    public function forgotPassword($email)
    {
        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            return true;
        }

        // Return the status string so the component can map it to an error
        return $status;
    }
    public function resetUserPassword(array $data)
    {
        return Password::broker('users')->reset(
            $data,
            function (User $user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
                Mail::to($user->email)
                    ->queue(new PasswordResetNotification($user));
            }
        );
    }

    public function updateMyPassword(array $data)
    {
        // 1. Get the authenticated user
        $user = auth()->user();

        // 2. Verify the current password matches what's in the database
        if (!\Hash::check($data['current_password'], $user->password)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'current_password' => ['The provided password does not match our records.'],
            ]);
        }

        // 3. Update the user's password
        // Note: Laravel 10+ automatically hashes strings assigned to 'password' 
        // if the model has the 'hashed' cast, otherwise use Hash::make()
        $user->update([
            'password' => \Hash::make($data['password']),
        ]);

        Mail::to($user->email)
                    ->queue(new PasswordChangedNotification($user));

        return $user;
    }
}
