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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama teknis (item_blink)
            $table->string('dname')->nullable(); // Nama layar (Blink Dagger)
            $table->integer('cost')->nullable();
            $table->text('desc')->nullable();
            $table->string('img_url')->nullable();
            $table->timestamps();
            $table->json('components')->nullable(); // List ID item bahan (ex: ["boots", "gloves"])
            $table->integer('recipe_cost')->nullable(); // Harga kertas resepnya
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
