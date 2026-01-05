<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Item;

class FetchItems extends Command
{
    protected $signature = 'dota:fetch-items';
    protected $description = 'Ambil data Items + Resep (Components)';

    public function handle()
    {
        $this->info('📦 Sedang mendownload data Item dari OpenDota...');

        $itemsData = Http::timeout(120)->get('https://api.opendota.com/api/constants/items')->json();

        if (!$itemsData) {
            $this->error('❌ Gagal download data item.');
            return;
        }

        $bar = $this->output->createProgressBar(count($itemsData));

        foreach ($itemsData as $key => $data) {
            if (empty($data['dname']) || empty($data['img'])) {
                continue;
            }

            Item::updateOrCreate(
                ['name' => $key], 
                [
                    'dname'   => $data['dname'],
                    'cost'    => $data['cost'] ?? 0,
                    'img_url' => 'https://cdn.cloudflare.steamstatic.com' . $data['img'],
                    
                    'components' => isset($data['components']) ? $data['components'] : null,
                    
                    'recipe_cost' => (str_contains($key, 'recipe')) ? 1 : 0, 
                ]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('🎉 Sukses! Item dan Resep Crafting tersimpan.');
    }
}