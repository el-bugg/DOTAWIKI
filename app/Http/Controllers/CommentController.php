<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; // Pastikan Model Comment sudah ada
use App\Models\Post;    // Sesuaikan dengan nama model postingan Anda (misal CommunityPost)
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // Validasi input
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Simpan komentar
        Comment::create([
            'post_id' => $postId,     // ID Postingan
            'user_id' => Auth::id(),  // ID User yang login
            'body'    => $request->body
        ]);

        // Kembali ke halaman sebelumnya
        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}