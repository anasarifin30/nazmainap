<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsGuestOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Jika user login dan bukan tamu, redirect sesuai rolenya
            if ($role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($role === 'subadmin') {
                return redirect('/subadmin/dashboard');
            } elseif ($role === 'owner') {
                return redirect('/owner/dashboard');
            }
        }

        return $next($request);
    }
}
