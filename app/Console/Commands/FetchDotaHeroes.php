<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Hero;

class FetchDotaHeroes extends Command
{
    protected $signature = 'dota:fetch-heroes';
    protected $description = 'Ambil data Hero (Stats Lengkap + Vision/Range) dari file lokal heroStats.json';

    public function handle()
    {
        $this->info('🚀 Memulai proses import Hero...');

        $path = base_path('heroStats.json');
        if (!file_exists($path)) {
            $this->error('❌ File heroStats.json tidak ditemukan!');
            $this->line('Silakan download manual dari: https://api.opendota.com/api/heroStats');
            $this->line('Lalu simpan di folder root project (sejajar dengan artisan).');
            return;
        }

        $heroesData = json_decode(file_get_contents($path), true);
        $this->info('✅ File ditemukan! Memproses ' . count($heroesData) . ' hero...');

        $this->info('Mengambil data Lore dari API...');
        $loreMap = Http::get('https://api.opendota.com/api/constants/hero_lore')->json();

        $bar = $this->output->createProgressBar(count($heroesData));

        foreach ($heroesData as $data) {
            Hero::updateOrCreate(
                ['id' => $data['id']],
                [
                    'code_name'      => $data['name'],
                    'name_localized' => $data['localized_name'],
                    'primary_attr'   => $data['primary_attr'],
                    'attack_type'    => $data['attack_type'],
                    'roles'          => $data['roles'], // Otomatis jadi JSON
                    'img_url'        => 'https://cdn.cloudflare.steamstatic.com' . $data['img'],
                    'icon_url'       => 'https://cdn.cloudflare.steamstatic.com' . $data['icon'],
                    'lore'           => $loreMap[$data['name']] ?? 'No lore available.',

                    // Stats Dasar
                    'base_health' => $data['base_health'],
                    'base_mana'   => $data['base_mana'],
                    'base_str'    => $data['base_str'],
                    'base_agi'    => $data['base_agi'],
                    'base_int'    => $data['base_int'],
                    'str_gain'    => $data['str_gain'],
                    'agi_gain'    => $data['agi_gain'],
                    'int_gain'    => $data['int_gain'],

                    // Stats Detail (Vision, Range, Speed)
                    'move_speed'   => $data['move_speed'],
                    'attack_range' => $data['attack_range'],
                    'day_vision'   => $data['day_vision'],
                    'night_vision' => $data['night_vision'],

                    'pro_pick'    => $data['pro_pick'] ?? 0,
                    'pro_win'     => $data['pro_win'] ?? 0,
                    'turbo_picks' => $data['turbo_picks'] ?? 0,
                    'turbo_wins'  => $data['turbo_wins'] ?? 0,
                ]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('🎉 Sukses! Semua Hero dan Stats Detail sudah masuk database.');
    }
}
