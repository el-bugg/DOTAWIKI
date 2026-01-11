<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
{
    $posts = Post::with('user', 'likes', 'comments')->latest()->get();
    
    // Pastikan Model Hero dan Item punya kolom 'image' atau sesuaikan path-nya
    // Contoh return: id, name, image (url/path)
    $heroes = \App\Models\Hero::select('id', 'name', 'image')->orderBy('name')->get(); 
    $items = \App\Models\Item::select('id', 'name', 'image')->orderBy('name')->get();

    return view('community.index', compact('posts', 'heroes', 'items'));
}

    public function store(Request $request) {
        $request->validate([
            'category' => 'required',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg|max:20000',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->category = $request->category;
        $post->content = $request->content ?? '';

        // Handle File Upload
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts/images', 'public');
        }
        if ($request->hasFile('video')) {
            $post->video = $request->file('video')->store('posts/videos', 'public');
        }

        // Handle Match Result (Jika kategori match)
        if ($request->category === 'match_result') {
            $post->match_data = [
                'hero' => $request->hero_name,
                'kda' => $request->kda,
                'result' => $request->match_result, // Win/Loss
                'match_id' => $request->match_id
            ];
        }

        $post->save();
        return back()->with('success', 'Berhasil diposting!');
    }

    public function destroy(Post $post)
    {
        // Pastikan yang menghapus adalah pemilik postingan
        if (Auth::id() !== $post->user_id) {
            return back()->with('error', 'Unauthorized');
        }

        $post->delete();
        return back()->with('success', 'Postingan dihapus.');
    }
    
    // Fitur Like
    public function toggleLike(Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();
        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create(['user_id' => Auth::id()]);
        }
        return back();
    }
}