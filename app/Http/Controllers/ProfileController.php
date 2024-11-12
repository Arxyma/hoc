<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
        // Validasi dan update data user termasuk field tambahan
        $user = $request->user();
        $user->fill($request->validated());

        // Jika ada unggahan foto profil, proses unggahan file
        if ($request->hasFile('foto_profil')) {
            // Simpan foto profil baru
            $path = $request->file('foto_profil')->store('foto_profil', 'public');

            // Hapus foto profil lama jika ada
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Update path foto profil di database
            $user->foto_profil = $path;
        }

        // Jika email berubah, verifikasi ulang
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Simpan perubahan user
        $user->save();

        // Redirect ke halaman profile dengan pesan status
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
}
