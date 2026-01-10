<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // Baris ini penting! Mengizinkan semua kolom (user_id, post_id) untuk diisi
    protected $guarded = []; 
}