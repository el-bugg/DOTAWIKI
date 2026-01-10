<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        $heroes = [
            [
                'name' => 'npc_dota_hero_antimage',
                'localized_name' => 'Anti-Mage',
                'primary_attr' => 'agi',
                'attack_type' => 'Melee',
                'img' => 'https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/heroes/antimage.png',
            ],
            [
                'name' => 'npc_dota_hero_juggernaut',
                'localized_name' => 'Juggernaut',
                'primary_attr' => 'agi',
                'attack_type' => 'Melee',
                'img' => 'https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/heroes/juggernaut.png',
            ],
            [
                'name' => 'npc_dota_hero_axe',
                'localized_name' => 'Axe',
                'primary_attr' => 'str',
                'attack_type' => 'Melee',
                'img' => 'https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/heroes/axe.png',
            ],
            // Tambahkan hero lain di sini jika perlu
        ];

        foreach ($heroes as $hero) {
            Hero::create($hero);
        }
    }
}