<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
           $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('content')->nullable(); // Nullable karena bisa jadi cuma share match
        $table->string('category'); 
        $table->string('image')->nullable();
        $table->string('video')->nullable();
        
        // Data Match (Disimpan dalam format JSON: {hero: "Invoker", kda: "10/2/15", result: "Win", match_id: "12345"})
        $table->json('match_data')->nullable();
            
            // Kolom nullable untuk relasi opsional
            $table->foreignId('hero_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('set null');
            
            // Kolom tambahan jika diperlukan nanti (misal JSON untuk banyak item)
            $table->json('recommended_items')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};