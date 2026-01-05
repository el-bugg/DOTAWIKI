<?php
namespace App\Http\Controllers;
use App\Models\Hero;

class MetaController extends Controller {
    public function index() {
        $heroes = Hero::all()->sortByDesc(function($h) {
            return $h->pro_pick > 0 ? ($h->pro_win / $h->pro_pick) : 0;
        });
        return view('meta.index', compact('heroes'));
    }
}