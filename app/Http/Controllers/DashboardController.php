<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard Sendiri
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->withCount('likes')->latest()->get();
        $isOwnProfile = true;

        return view('dashboard', compact('user', 'posts', 'isOwnProfile'));
    }

    // Profil Orang Lain
    public function showUserProfile(User $user)
    {
        $posts = Post::where('user_id', $user->id)->withCount('likes')->latest()->get();
        
        // Cek apakah user yang login melihat profilnya sendiri via link public
        $isOwnProfile = (Auth::id() === $user->id);

        return view('dashboard', compact('user', 'posts', 'isOwnProfile'));
    }
}