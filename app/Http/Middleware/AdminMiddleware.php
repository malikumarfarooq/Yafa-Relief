<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Not authenticated
        if (!$user) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Please login to access admin panel.');
        }

        // Not admin
        if ($user->user_type !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized access.');
        }

        // Inactive account
        if (!$user->is_active) {
            Auth::logout();

            return redirect()
                ->route('admin.login')
                ->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
