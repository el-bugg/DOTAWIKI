<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil data dari API OpenDota
        $response = Http::get('https://api.opendota.com/api/constants/items');

        if ($response->successful()) {
            $items = $response->json();

            foreach ($items as $key => $item) {
                // 2. Filter: Lewati jika resep (recipe) atau tidak punya nama tampilan
                if (str_contains($key, 'recipe') || !isset($item['dname'])) {
                    continue;
                }

                $cost = $item['cost'] ?? 0;
                
                // 3. Logika Klasifikasi (Mirip Liquipedia)
                $category = 'Miscellaneous';
                
                if ($cost <= 250 && ($item['consumable'] ?? false)) {
                    $category = 'Consumables';
                } elseif ($cost <= 600 && !isset($item['components'])) {
                    $category = 'Attributes';
                } elseif (isset($item['secret_shop']) && $item['secret_shop'] == 1) {
                    $category = 'Secret Shop';
                } elseif (isset($item['components']) && is_array($item['components'])) {
                    $category = ($cost >= 2000) ? 'Upgraded Items' : 'Accessories';
                }

                // 4. Simpan ke Database
                Item::updateOrCreate(
                    ['name' => $key], // ID unik (misal: item_blink)
                    [
                        'dname'      => $item['dname'],
                        'category'   => $category,
                        'cost'       => $cost,
                        'desc'       => isset($item['hint']) ? strip_tags(implode(' ', $item['hint'])) : null,
                        'img_url'    => "https://cdn.cloudflare.steamstatic.com" . $item['img'],
                        'components' => isset($item['components']) ? $item['components'] : null,
                    ]
                );
            }
            $this->command->info('Item Seeder berhasil dijalankan!');
        } else {
            $this->command->error('Gagal mengambil data dari API.');
        }
    }
}