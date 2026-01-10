<?php

namespace App\Http\Controllers;

// TAMBAHKAN DUA BARIS INI:
use App\Models\Post; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// Jika Anda sudah punya model Post, hilangkan tanda // di bawah ini:
// use App\Models\Post; 

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil postingan milik user yang sedang login
        // 2. Sertakan hitungan likes (withCount)
        $myPosts = Post::where('user_id', Auth::id())
                       ->withCount('likes')
                       ->latest()
                       ->get();

        // 3. Kirim variabel $myPosts ke view dashboard
        return view('dashboard', compact('myPosts'));
    }

    public function community()
    {
        // Lakukan hal yang sama untuk halaman community
        return view('community', [
            'posts' => []
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'content' => 'required',
        ]);

        // LOGIKA SIMPAN (Sementara dinonaktifkan agar tidak error database)
        // Post::create([...]);

        return redirect()->back()->with('success', 'Postingan berhasil dikirim (simulasi)!');
    }
}