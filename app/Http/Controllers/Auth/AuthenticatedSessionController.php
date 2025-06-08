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
        return view('auth.auth');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $role = $request->input('login_role'); // 'guest' atau 'owner'

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Email atau password salah.')->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($role && $role !== $user->role) {
            Auth::logout();
            return redirect()->back()->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai ' . $role,
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
        // Logout pengguna
        Auth::guard('web')->logout();

        // Hapus sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login umum
        return redirect('/login');
    }
}
