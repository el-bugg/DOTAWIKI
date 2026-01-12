<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'category',
        'image',
        'video',
        'hero_id',
        'item_id',
        'match_data',        // <--- Pastikan ini ada
        'recommended_items', // <--- Pastikan ini ada (sesuai nama di migration)
    ];

    // INI YANG PALING PENTING UNTUK FITUR MATCH RESULT
    // Fungsinya mengubah JSON dari database menjadi Array PHP otomatis
    protected $casts = [
        'match_data' => 'array',
        'recommended_items' => 'array',
    ];

   public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isLikedByAuthUser()
    {
        if (!Auth::check()) return false;
        return $this->likes()->where('user_id', Auth::id())->exists();
    }
}