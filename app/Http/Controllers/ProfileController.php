<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
    dd("hallo");
    $user = $request->user();

        // 1. Validasi fields baru
        $request->validate([
            'social_media' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File upload
        ]);

        // 2. Proses File Upload
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            
            // Simpan foto baru
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $photoPath;
        }

        // 3. Update fields standar (name, email)
        $user->fill($request->validated());

        // 4. Update fields baru
        $user->social_media = $request->social_media;
        $user->description = $request->description;

        // 5. Simpan data
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.view')->with('status', 'profile-updated'); // Redirect ke view profile baru
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function view(): View
    {
        return view('profile.view', [
            'user' => Auth::user(),
        ]);
    }
}
