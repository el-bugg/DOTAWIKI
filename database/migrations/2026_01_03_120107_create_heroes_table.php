<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('code_name')->unique(); // npc_dota_hero_antimage
            $table->string('name_localized');      // Anti-Mage
            $table->string('primary_attr');        // agi
            $table->string('attack_type');         // Melee
            $table->json('roles');                 // ["Carry", "Escape"]
            $table->string('img_url');
            $table->string('icon_url')->nullable();
            $table->string('video_url')->nullable(); // Video Header
            $table->text('lore')->nullable();

            // Stats Dasar
            $table->integer('base_health')->nullable();
            $table->integer('base_mana')->nullable();
            $table->integer('base_str')->nullable();
            $table->integer('base_agi')->nullable();
            $table->integer('base_int')->nullable();
            $table->float('str_gain')->nullable();
            $table->float('agi_gain')->nullable();
            $table->float('int_gain')->nullable();

            // Stats Detail
            $table->integer('move_speed')->nullable();
            $table->integer('attack_range')->nullable();
            $table->integer('day_vision')->nullable();
            $table->integer('night_vision')->nullable();

            // Guide Data (Scraped)
            $table->text('playstyle')->nullable();
            $table->json('pros')->nullable();
            $table->json('cons')->nullable();
            $table->json('item_builds')->nullable();

            // ... di dalam Schema::create ...
            $table->integer('pro_pick')->default(0);
            $table->integer('pro_win')->default(0);
            $table->integer('turbo_picks')->default(0);
            $table->integer('turbo_wins')->default(0);
            // ...

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
