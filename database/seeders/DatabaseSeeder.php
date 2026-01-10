<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    \App\Models\User::factory()->create([
        'name' => 'Coba',
        'email' => 'test@example.com',
        'password' => bcrypt('password'), // Passwordnya: password
    ]);

    $this->call([
        HeroOpenDotaSeeder::class,
        ItemSeeder::class,
    ]);
}
}
