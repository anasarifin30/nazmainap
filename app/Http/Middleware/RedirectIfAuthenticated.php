<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = \Illuminate\Support\Facades\Auth::user();

            // Redirect berdasarkan role
            return match ($user->role) {
                'admin' => redirect('/admin'),
                'subadmin' => redirect('/subadmin'),
                'owner' => redirect('/owner'),
                'guest' => redirect('/'),
                default => redirect('/'),
            };
        }

        return $next($request);
    }
}