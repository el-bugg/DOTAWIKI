<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index(Request $request)
    {
        $query = Hero::query();

        if ($request->has('search')) {
            $query->where('name_localized', 'like', '%' . $request->search . '%');
        }

        if ($request->has('attr')) {
            $attr = strtolower($request->attr);
            if (in_array($attr, ['str', 'agi', 'int', 'all'])) {
                $query->where('primary_attr', $attr);
            }
        }

        $heroes = $query->orderBy('name_localized')->get();

        return view('heroes.index', compact('heroes'));
    }

    public function show($id)
    {
        // WAJIB: tambahkan ->with('abilities') agar data skill terambil
    $hero = Hero::with('abilities')->findOrFail($id);
    
    // Logic Previous/Next Hero
    $prevHero = Hero::where('id', '<', $hero->id)->orderBy('id', 'desc')->first() ?? Hero::orderBy('id', 'desc')->first();
    $nextHero = Hero::where('id', '>', $hero->id)->orderBy('id', 'asc')->first() ?? Hero::first();

    return view('heroes.show', compact('hero', 'prevHero', 'nextHero'));
    }
  public function meta(Request $request)
{
    // Ambil parameter sort, default ke 'pro_pick'
    $sort = $request->get('sort', 'pro_pick');
    // Ambil arah sort, default ke 'desc'
    $direction = $request->get('direction', 'desc');

    // Validasi kolom agar aman dari SQL Injection
    $validColumns = ['pro_pick', 'pro_win', 'pro_ban', 'name_localized'];
    if (!in_array($sort, $validColumns)) { $sort = 'pro_pick'; }

    // Query utama untuk tabel analytics
    $heroes = Hero::orderBy($sort, $direction)->get();

    // Logic khusus untuk OP HEROES (Top 10 Win Rate)
    // Pastikan minimal 10 pick agar data ban/win tidak bias
    $topWinrate = Hero::where('pro_pick', '>', 10)
        ->get()
        ->sortByDesc(function($hero) {
            return $hero->pro_pick > 0 ? ($hero->pro_win / $hero->pro_pick) : 0;
        })
        ->take(10);

    return view('meta.index', compact('heroes', 'topWinrate'));
}
}
