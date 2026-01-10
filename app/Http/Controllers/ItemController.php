<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Post;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Method untuk menampilkan daftar item (Penyelesaian error image_4287c8.png)
    public function index()
    {
        $itemsByCategory = Item::all()->groupBy('category');
        return view('items.index', compact('itemsByCategory'));
    }

    // Method untuk menampilkan detail item (Penyelesaian error image_428eef.png)
    public function show($id)
    {
        $item = Item::findOrFail($id);
        
        // Mengambil guide komunitas yang merekomendasikan item ini
        $communityGuides = Post::where('category', 'item_guide')
                            ->where('content', 'like', '%' . $item->dname . '%')
                            ->with('user')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('items.show', compact('item', 'communityGuides'));
    }
}