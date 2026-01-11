<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hero;

class HeroVideoSeeder extends Seeder
{
    public function run()
    {
        // 1. Daftar Pengecualian (Nama Hero vs Nama File Video Valve)
        // Valve sering menggunakan nama internal (legacy) untuk file asset.
        $exceptions = [
            'Anti-Mage' => 'antimage',
            'Centaur Warrunner' => 'centaur',
            'Clockwerk' => 'rattletrap',
            'Doom' => 'doom_bringer',
            'Io' => 'wisp',
            'Lifestealer' => 'life_stealer',
            'Magnus' => 'magnataur',
            'Nature\'s Prophet' => 'furion',
            'Necrophos' => 'necrolyte',
            'Outworld Destroyer' => 'obsidian_destroyer',
            'Queen of Pain' => 'queenofpain',
            'Shadow Fiend' => 'nevermore',
            'Timbersaw' => 'shredder',
            'Treant Protector' => 'treant',
            'Underlord' => 'abyssal_underlord',
            'Vengeful Spirit' => 'vengefulspirit',
            'Windranger' => 'windrunner',
            'Wraith King' => 'wraith_king',
            'Zeus' => 'zuus',
            'Primal Beast' => 'primal_beast',
            'Dawnbreaker' => 'dawnbreaker',
            'Marci' => 'marci',
            'Muerta' => 'muerta',
            'Kez' => 'kez', 
            'Ringmaster' => 'ringmaster',
            // Hero yang namanya beda tipis atau tidak pakai spasi di file
            'Broodmother' => 'broodmother', // kadang brood_mother, tapi di react broodmother
            'Night Stalker' => 'night_stalker',
        ];

        // 2. Ambil semua hero dari database
        $heroes = Hero::all();

        foreach ($heroes as $hero) {
            $name = $hero->name_localized;
            $videoName = '';

            // Cek apakah hero ini ada di daftar pengecualian?
            if (array_key_exists($name, $exceptions)) {
                $videoName = $exceptions[$name];
            } else {
                // Jika tidak ada di pengecualian, gunakan format standar:
                // Lowercase dan spasi diganti underscore.
                // Contoh: "Crystal Maiden" -> "crystal_maiden"
                $videoName = strtolower(str_replace([' ', '-', "'"], ['_', '_', ''], $name));
            }

            // 3. Susun URL Video
            $url = "https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/heroes/renders/{$videoName}.webm";

            // 4. Update Database
            $hero->update(['video_url' => $url]);
            
            // Opsional: Tampilkan progress di terminal
            $this->command->info("Updated video for: {$name} -> {$videoName}");
        }
    }
}