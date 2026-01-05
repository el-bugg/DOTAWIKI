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
        $hero = Hero::with('abilities')->findOrFail($id);
        $prevHero = Hero::where('id', '<', $hero->id)->orderBy('id', 'desc')->first() ?? Hero::orderBy('id', 'desc')->first();
        $nextHero = Hero::where('id', '>', $hero->id)->orderBy('id', 'asc')->first() ?? Hero::first();
        return view('heroes.show', compact('hero', 'prevHero', 'nextHero'));
    }
}
