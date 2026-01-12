<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DashboardController;
use App\Models\Hero;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $heroes = Hero::inRandomOrder()->limit(12)->get();
    $topWinrate = Hero::where('pro_pick', '>', 10)->get()
        ->sortByDesc(fn($hero) => $hero->pro_pick > 0 ? ($hero->pro_win / $hero->pro_pick) : 0)
        ->take(5);
    $topPicked = Hero::orderByDesc('pro_pick')->take(5)->get();

    return view('welcome', compact('heroes', 'topWinrate', 'topPicked'));
});

// Pastikan ini ada agar menu Heroes dan Items berfungsi
Route::get('/heroes', [HeroController::class, 'index'])->name('heroes.index');
Route::get('/heroes/{id}', [HeroController::class, 'show'])->name('heroes.show');
Route::get('/hero/{id}', [HeroController::class, 'show'])->name('hero.show');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');
Route::get('/meta', [HeroController::class, 'meta'])->name('meta.index');
// Route::get('/community', [DashboardController::class, 'community'])->name('community');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    // Di dalam Route::middleware('auth')->group(function () { ...
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');


  // DASHBOARD (Halaman Sendiri)
  
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // PUBLIC PROFILE (Halaman Orang Lain)
    Route::get('/user/{user}', [DashboardController::class, 'showUserProfile'])->name('profile.show');

    // COMMUNITY
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
    Route::get('/community/hero', [CommunityController::class, 'heroGuide'])->name('community.hero'); // <-- INI YANG HILANG
    Route::get('/community/item', [CommunityController::class, 'itemGuide'])->name('community.item'); // <-- INI JUGA MUNGKIN HILANG
    Route::post('/community/post', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/community/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    
Route::post('/community/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth'); 

    // ACTION POST
    Route::delete('/post/{post}', [CommunityController::class, 'destroy'])->name('post.destroy'); // Hapus Post
    Route::post('/post/{post}/like', [CommunityController::class, 'toggleLike'])->name('post.like'); // Like

    // FOLLOW SYSTEM
    Route::post('/follow/{user}', [FollowController::class, 'store'])->name('user.follow');
    Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])->name('user.unfollow');
});

require __DIR__.'/auth.php';