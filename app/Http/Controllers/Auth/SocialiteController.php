<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    // Arahkan pengguna ke halaman otentikasi Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Tangani informasi yang dikembalikan Google (Login/Register)
    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // 1. Cek apakah user sudah ada di database berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User sudah terdaftar (LOGIN)
                Auth::login($user);
            } else {
                // User belum terdaftar (SIGN UP)
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'email_verified_at' => now(),
                    // Karena login menggunakan Socialite, kita bisa membuat password acak
                    'password' => Hash::make(Str::random(16)), 
                    'role' => 'user', // Default role
                    // Anda bisa menyimpan Google ID jika ingin: 
                    // 'google_id' => $googleUser->getId(),
                ]);

                Auth::login($user);
            }

            // Arahkan ke dashboard (Logika role check di web.php akan mengarahkan user/admin)
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            // Log error atau kembalikan ke halaman login dengan pesan error
            \Log::error('Socialite Google Login Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Gagal login dengan Google. Silakan coba cara lain.']);
        }
    }
}