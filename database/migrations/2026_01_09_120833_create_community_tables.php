<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content')->nullable(); // Boleh null jika cuma upload gambar
            $table->string('category'); // general, hero_guide, item_guide, match_result
            
            // Kolom Media
            $table->string('image')->nullable();
            $table->string('video')->nullable();

            // Kolom Relasi Opsional (Untuk Guide)
            $table->foreignId('hero_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};