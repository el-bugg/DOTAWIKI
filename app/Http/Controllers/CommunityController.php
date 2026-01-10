<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CommunityController extends Controller
{
    public function index() {
        $posts = Post::with(['user', 'comments', 'likes'])->latest()->get();
        
        // Proteksi API agar tidak Connection Timeout (Error cURL 28)
        $dotaNews = [];
        try {
            $response = Http::timeout(3)->get('https://api.steampowered.com/ISteamNews/GetNewsForApp/v2/?appid=570&count=3');
            if ($response->successful()) {
                $dotaNews = $response->json()['appnews']['newsitems'] ?? [];
            }
        } catch (\Exception $e) {
            // Jika koneksi internet mati/lambat, dotaNews tetap kosong tapi aplikasi tidak error
        }

        return view('community.index', compact('posts', 'dotaNews'));
    }

    public function store(Request $request) {
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg|max:20000',
            'category' => 'required'
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->content;
        $post->category = $request->category;

        // Logika upload file agar tersimpan di storage
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts/images', 'public');
        }
        if ($request->hasFile('video')) {
            $post->video = $request->file('video')->store('posts/videos', 'public');
        }

        $post->save();
        return back()->with('success', 'Berhasil diposting!');
    }

    // Perbaikan View Guide agar tidak InvalidArgumentException
    public function newbie() { return view('community.index', ['posts' => Post::where('category', 'newbie_guide')->get(), 'dotaNews' => []]); }
    public function heroGuide() { return view('community.index', ['posts' => Post::where('category', 'hero_guide')->get(), 'dotaNews' => []]); }
    public function itemGuide() { return view('community.index', ['posts' => Post::where('category', 'item_guide')->get(), 'dotaNews' => []]); }
}