<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    public $incrementing = false;
    protected $guarded = [];

    protected $casts = [
        'roles' => 'array',
        'item_builds' => 'array', 
        'mana_cost' => 'array',   
        'cooldown' => 'array',    
        'pros' => 'array', 
        'cons' => 'array', 
    ];

    public function abilities()
    {
        return $this->hasMany(Ability::class);
    }
}
