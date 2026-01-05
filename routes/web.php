<?php

use App\Models\Hero;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $heroes = Hero::inRandomOrder()->limit(12)->get();

    $topWinrate = Hero::where('pro_pick', '>', 10)->get()
        ->sortByDesc(function ($hero) {
            return $hero->pro_pick > 0 ? ($hero->pro_win / $hero->pro_pick) : 0;
        })
        ->take(5);

    $topPicked = Hero::orderByDesc('pro_pick')->take(5)->get();

    return view('welcome', compact('heroes', 'topWinrate', 'topPicked'));
});

Route::get('/heroes', [App\Http\Controllers\HeroController::class, 'index'])->name('heroes.index');
Route::get('/hero/{id}', [App\Http\Controllers\HeroController::class, 'show'])->name('hero.show');
Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';