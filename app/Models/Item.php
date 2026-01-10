<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Mengizinkan pengisian data massal sesuai kolom di migrasi Anda
    protected $fillable = [
        'name', 'dname', 'category', 'cost', 'desc', 'img_url', 'components', 'recipe_cost'
    ];

    // Memastikan data components (array) tersimpan sebagai JSON yang benar
    protected $casts = [
        'components' => 'array'
    ];
    // Di dalam class Item
public function posts()
{
    return $this->hasMany(Post::class);
}
}