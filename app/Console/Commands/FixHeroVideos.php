<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hero;

class FixHeroVideos extends Command
{
    protected $signature = 'dota:fix-videos';
    protected $description = 'Generate Video URL for Heroes based on Valve pattern';

    public function handle()
    {
        $heroes = Hero::all();
        $this->info('Memperbaiki Video URL untuk ' . $heroes->count() . ' hero...');

        foreach ($heroes as $hero) {
            $shortName = str_replace('npc_dota_hero_', '', $hero->code_name);

            $map = [
                'nevermore' => 'shadow_fiend',
                'rattletrap' => 'clockwerk',
                'magnataur' => 'magnus',
                'wisp' => 'io',
                'obsidian_destroyer' => 'outworld_destroyer',
                'skeleton_king' => 'wraith_king',
                'zuus' => 'zeus',
                'doom_bringer' => 'doom',
                'treant' => 'treant_protector',
                'life_stealer' => 'lifestealer',
                'windrunner' => 'windranger',
                'vengefulspirit' => 'vengeful_spirit',
            ];

            if (array_key_exists($shortName, $map)) {
                $shortName = $map[$shortName];
            }

            $videoUrl = "https://cdn.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/{$shortName}.webm";

            $hero->update(['video_url' => $videoUrl]);
        }

        $this->info('✅ Selesai! Video header sudah kembali.');
    }
}