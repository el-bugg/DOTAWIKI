<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\DashboardControllerphp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
    public function updatePhoto(Request $request)
{
    $request->validate([
        'avatar' => ['required', 'image', 'max:2048'], // Maks 2MB
    ]);

    $user = $request->user();

    // Hapus foto lama jika ada
    if ($user->avatar) {
        Storage::delete($user->avatar);
    }

    // Simpan foto baru
    $path = $request->file('avatar')->store('avatars', 'public');
    
    // Update database (Pastikan tabel users punya kolom 'avatar')
    // Jika belum punya kolom avatar, jalankan migration dulu atau gunakan kolom lain
    $user->update(['avatar' => $path]);

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}
// app/Http/Controllers/DashboardController.php

public function index()
{
    // Mengambil postingan milik user yang login beserta jumlah like
    $myPosts = Post::where('user_id', auth()->id())
                   ->withCount('likes')
                   ->latest()
                   ->get();

    return view('dashboard', compact('myPosts'));
}
}
