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

    public function store(Request $request)
{
    // 1. Tentukan aturan dasar (Wajib untuk semua form)
    $rules = [
        'category' => 'required|string',
        'content'  => 'required|string|max:1000',
        'image'    => 'nullable|image|max:2048', // Opsional untuk keduanya
    ];

    // 2. Tambahkan aturan KHUSUS jika postingan datang dari Community (Tab Match/Build)
    if ($request->category === 'match_result') {
        $rules['hero_name'] = 'required|string';
        $rules['match_result'] = 'required|in:Win,Loss';
        $rules['kda'] = 'required|string';
    } 
    elseif ($request->category === 'hero_build' || $request->category === 'item_build') {
        $rules['hero_id'] = 'required|exists:heroes,id';
        $rules['items'] = 'nullable|array';
    }
    

    // 3. Jalankan Validasi Dinamis
    $validated = $request->validate($rules);

    // 4. Proses Upload Gambar (Sama untuk keduanya)
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    // 5. Siapkan Data Tambahan (Match Data) hanya jika kategori match
    $matchData = null;
    if ($request->category === 'match_result') {
        $matchData = [
            'hero_name' => $request->hero_name,
            'result'    => $request->match_result,
            'kda'       => $request->kda,
        ];
    }

    // 6. Simpan ke Database
    $post = Post::create([
        'user_id'    => Auth::id(),
        'category'   => $request->category, // Ini otomatis mendeteksi 'general' atau 'match'
        'content'    => $request->content,
        'image'      => $imagePath,
        'hero_id'    => $request->hero_id ?? null, // Pakai null operator agar form dashboard profile gak error
        'match_data' => $matchData,            // Laravel otomatis mengubah array jadi JSON jika di-cast di model
        // PERBAIKAN DISINI: Ganti 'items' menjadi 'recommended_items'
        'recommended_items' => $request->items ?? null,
    ]);

    return back()->with('success', 'Postingan berhasil diterbitkan!');
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