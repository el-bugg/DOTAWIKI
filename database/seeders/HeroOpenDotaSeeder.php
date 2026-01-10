<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hero;
use Illuminate\Support\Facades\Http;

class HeroOpenDotaSeeder extends Seeder
{
   // database/seeders/HeroOpenDotaSeeder.php
public function run(): void
{
    $response = \Illuminate\Support\Facades\Http::get('https://api.opendota.com/api/heroStats');

    if ($response->successful()) {
        foreach ($response->json() as $hero) {
            \App\Models\Hero::updateOrCreate(
                ['name_localized' => $hero['localized_name']],
                [
                    'code_name'      => $hero['name'],
                    'primary_attr'   => $hero['primary_attr'],
                    'attack_type'    => $hero['attack_type'],
                    'roles'          => $hero['roles'], // Otomatis jadi JSON karena $casts
                    'img_url'        => "https://cdn.cloudflare.steamstatic.com" . $hero['img'],
                    'icon_url'       => "https://cdn.cloudflare.steamstatic.com" . $hero['icon'],
                    'base_health'    => $hero['base_health'],
                    'base_mana'      => $hero['base_mana'],
                    'base_str'       => $hero['base_str'],
                    'base_agi'       => $hero['base_agi'],
                    'base_int'       => $hero['base_int'],
                    'str_gain'       => $hero['str_gain'],
                    'agi_gain'       => $hero['agi_gain'],
                    'int_gain'       => $hero['int_gain'],
                    'move_speed'     => $hero['move_speed'],
                    'attack_range'   => $hero['attack_range'],
                    'day_vision'     => $hero['day_vision'],
                    'night_vision'   => $hero['night_vision'],
                    'pro_pick'       => $hero['pro_pick'] ?? 0,
                    'pro_win'        => $hero['pro_win'] ?? 0,
                ]
            );
        }
    }
}
}