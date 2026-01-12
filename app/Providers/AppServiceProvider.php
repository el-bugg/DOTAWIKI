<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- JANGAN LUPA TAMBAHKAN BARIS INI

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa semua link (CSS/Gambar) jadi HTTPS jika sedang di Production
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}