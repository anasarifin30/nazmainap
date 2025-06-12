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
        // Validasi input
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'login_role' => ['required', 'string', 'in:guest,owner']
        ]);

        $role = $request->input('login_role'); // 'guest' atau 'owner'
        $credentials = $request->only('email', 'password');

        // Attempt login
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // Validasi role sesuai dengan yang dipilih
        if ($role !== $user->role) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return back()->withErrors([
                'email' => "Anda tidak memiliki akses sebagai {$role}. Akun Anda terdaftar sebagai {$user->role}.",
            ])->withInput($request->only('email'));
        }

        // Redirect berdasarkan role
        $redirectPath = match ($user->role) {
            'admin' => route('admin.dashboard'),
            'subadmin' => route('subadmin.dashboard'),
            'owner' => route('owner.dashboard'),
            'guest' => route('users.landingpage'), // Pastikan route ini benar
            default => route('users.landingpage'),
        };

        return redirect()->intended($redirectPath)
            ->with('success', "Selamat datang, {$user->name}!");
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke auth page, bukan login
        return redirect()->route('auth')
            ->with('success', 'Anda telah berhasil logout.');
    }
}
