<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Mengizinkan isi komentar, user_id, dan post_id disimpan
    protected $guarded = []; 

    // Relasi agar bisa menampilkan nama pengomentar
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}