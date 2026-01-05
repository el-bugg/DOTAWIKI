<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class DebugScraper extends Command
{
    protected $signature = 'dota:debug-scraper';
    protected $description = 'Cek struktur HTML Fandom untuk debugging';

    public function handle()
    {
        // Kita tes satu hero: Anti-Mage
        $wikiName = "Anti-Mage";
        $urlGuide = "https://dota2.fandom.com/wiki/{$wikiName}/Guide";
        
        $this->info("🔍 Menganalisa URL: $urlGuide");

        $response = Http::get($urlGuide);

        if ($response->failed()) {
            $this->error("❌ Gagal akses URL (Status: " . $response->status() . ")");
            return;
        }

        $this->info("✅ URL Bisa diakses!");
        $crawler = new Crawler($response->body());

        // 1. CEK JUDUL HEADER (Apakah ada 'Playstyle'?)
        $this->info("\n--- DAFTAR HEADER (H2) YANG DITEMUKAN ---");
        $crawler->filter('h2')->each(function ($node) {
            $this->line("   -> " . trim($node->text()));
        });

        // 2. CEK STRUKTUR ITEM
        $this->info("\n--- DAFTAR TEXT BOLD/HEADER KECIL (H3/H4/H5) ---");
        $crawler->filter('h3, h4, h5')->each(function ($node) {
            $text = trim($node->text());
            // Tampilkan hanya jika ada kata kunci item
            if (preg_match('/(Starting|Early|Mid|Late|Extension|Luxury)/i', $text)) {
                $this->info("   Found Item Section: " . $text);
                
                // Coba intip isinya
                $items = $node->nextAll()->filter('ul li a')->each(function($a){
                    return $a->attr('title');
                });
                
                if(!empty($items)){
                    $this->line("      Items: " . implode(', ', array_slice($items, 0, 3)) . "...");
                } else {
                    $this->error("      (KOSONG - Selector 'nextAll' mungkin salah)");
                }
            }
        });
    }
}