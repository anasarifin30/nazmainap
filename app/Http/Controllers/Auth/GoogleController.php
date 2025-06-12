<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        $role = $request->query('role', 'guest');
        session(['google_login_role' => $role]);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Perbaiki URL avatar Google
            $avatarUrl = $googleUser->getAvatar();
            if ($avatarUrl) {
                $avatarUrl = preg_replace('/=s\d+-c$/', '=s200-c', $avatarUrl);
            }
            
            DB::beginTransaction();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $role = session('google_login_role', 'guest');
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(uniqid()),
                    'role' => $role,
                    'foto' => $avatarUrl,
                    'email_verified_at' => now(),
                ]);
            } else {
                $updateData = [];
                
                if (!$user->foto || $user->foto !== $avatarUrl) {
                    $updateData['foto'] = $avatarUrl;
                }
                
                if (!$user->email_verified_at) {
                    $updateData['email_verified_at'] = now();
                }
                
                if (!empty($updateData)) {
                    $user->update($updateData);
                }
            }

            DB::commit();
            Auth::login($user, true);
            session()->forget('google_login_role');

            // Gunakan route names yang benar
            $redirectPath = match ($user->role) {
                'admin' => route('admin.dashboard'),
                'subadmin' => route('subadmin.dashboard'),
                'owner' => route('owner.dashboard'),
                'guest' => route('users.landingpage'),
                default => route('users.landingpage'),
            };

            return redirect($redirectPath)
                ->with('success', "Selamat datang, {$user->name}!");
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Google Login Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('auth')
                ->with('error', 'Login Google gagal. Silakan coba lagi.');
        }
    }
}
