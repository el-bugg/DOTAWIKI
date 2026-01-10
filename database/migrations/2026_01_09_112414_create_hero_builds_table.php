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
    Schema::create('hero_builds', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pembuat Build
        $table->foreignId('hero_id')->constrained()->onDelete('cascade'); // Untuk Hero apa
        $table->string('title'); // Judul Build (misal: "Anti-Mage Farming")
        $table->text('description')->nullable();
        $table->json('items_json'); // Simpan ID item: [1, 4, 12, 33]
        $table->integer('votes')->default(0); // Untuk sorting "Paling Populer"
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('hero_builds');
}
};
