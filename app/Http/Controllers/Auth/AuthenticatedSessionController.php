<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.loginguest');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        $user = Auth::user();
    
        if ($request->login_role && $request->login_role !== $user->role) {
            Auth::logout();
            return redirect()->back()->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai ' . $request->login_role,
            ]);
        }
    
        return redirect()->intended(match ($user->role) {
            'admin' => '/admin',
            'subadmin' => '/subadmin',
            'owner' => '/owner',
            'guest' => '/',
            default => '/',
        })->with('success', 'Berhasil masuk sebagai ' . $user->role);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Ambil role pengguna sebelum logout
        $role = Auth::user()->role;

        // Tentukan URL redirect berdasarkan role
        $redirectPath = match ($role) {
            'admin' => '/login/admin',
            'subadmin' => '/login/subadmin',
            'owner' => '/login/owner',
            'guest' => '/login/guest',
            default => '/login',
        };

        // Logout pengguna
        Auth::guard('web')->logout();

        // Hapus sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login sesuai role
        return redirect($redirectPath);
    }

    public function showGuestLogin()
    {
        return view('auth.loginguest');
    }

    public function showOwnerLogin()
    {
        return view('auth.loginowner');
    }

    public function showAdminLogin()
    {
        return view('auth.loginadmin');
    }
    
    public function showSubadminLogin()
    {
        return view('auth.loginsubadmin');
    }
}
