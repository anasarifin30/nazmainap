<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        $role = $request->query('role', 'guest'); // default guest
        session(['google_login_role' => $role]);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $role = session('google_login_role', 'guest');
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(uniqid()),
                    'role' => $role,
                    'foto' => $googleUser->getAvatar(),
                ]);
            }

            Auth::login($user, true);

            // Redirect sesuai role
            return redirect()->intended(match ($user->role) {
                'admin' => '/admin',
                'subadmin' => '/subadmin',
                'owner' => '/owner',
                'guest' => '/',
                default => '/',
            })->with('success', 'Berhasil login dengan Google!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login Google gagal.');
        }
    }
}
