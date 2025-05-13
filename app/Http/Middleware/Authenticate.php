<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        // Jika pengguna mencoba mengakses /admin dan belum login, arahkan ke login admin
        if ($request->is('admin*')) {
            return route('login.admin');
        }
        // Jika pengguna mencoba mengakses /subadmin dan belum login, arahkan ke login subadmin
        if ($request->is('subadmin*')) {
            return route('login.subadmin');
        }

        // Jika pengguna mencoba mengakses /owner dan belum login, arahkan ke login owner
        if ($request->is('owner*')) {
            return route('login.owner');
        }


        // Redirect default jika tidak login
        return route('login');
    }
}