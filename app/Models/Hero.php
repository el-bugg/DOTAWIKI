<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan import ini

class Hero extends Model
{
    use HasFactory; // Trait ditaruh di paling atas

    // Gunakan salah satu guarded saja (yang ['id'] lebih aman)
    protected $guarded = ['id']; 

    protected $casts = [
        'roles' => 'array',
        'item_builds' => 'array',
        'pros' => 'array',
        'cons' => 'array',
    ];

    // Relasi ke Abilities
    public function abilities() {
        return $this->hasMany(Ability::class);
    }

    // Relasi ke Posts (Ini yang tadi bikin error)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}