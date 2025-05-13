<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotOwner
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Cek apakah user login sebagai 'owner'
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request);
        }

        // Jika bukan owner, redirect ke halaman sesuai role atau login
        if (Auth::check()) {
            // Misal jika admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }
            // Misal jika guest
            elseif (Auth::user()->role === 'guest') {
                return redirect()->route('dashboard.guest');
            }  
            // misal jika subadmin
            elseif (Auth::user()->role === 'subadmin') {
                return redirect()->route('dashboard.subadmin');
            }
        }

        // Jika belum login, arahkan ke login owner
        return redirect()->route('login.owner');
    }
}
