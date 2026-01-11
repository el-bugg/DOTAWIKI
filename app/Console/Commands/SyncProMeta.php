<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hero;
use Illuminate\Support\Facades\Http;

class SyncProMeta extends Command
{
    protected $signature = 'dota:sync-meta';
    protected $description = 'Ambil data Pick/Ban asli dari OpenDota API';

    public function handle()
    {
        $this->info('Mengambil data dari OpenDota...');
        $response = Http::get('https://api.opendota.com/api/heroStats');

        if ($response->successful()) {
            foreach ($response->json() as $stat) {
                Hero::where('name_localized', $stat['localized_name'])->update([
                    'pro_pick' => $stat['pro_pick'] ?? 0,
                    'pro_ban'  => $stat['pro_ban'] ?? 0,
                    'pro_win'  => $stat['pro_win'] ?? 0,
                ]);
            }
            $this->info('Data Pro Meta berhasil diperbarui!');
        }
    }
}