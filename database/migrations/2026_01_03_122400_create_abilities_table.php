<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            // Hubungkan dengan tabel heroes
            $table->foreignId('hero_id')->constrained('heroes')->onDelete('cascade');
            
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('img_url')->nullable();
            
            // Stats Skill (Disimpan sebagai string karena formatnya "100/120/140")
            $table->string('mana_cost')->nullable();
            $table->string('cooldown')->nullable();
            
            // Kolom yang tadi ERROR (Missing)
            $table->string('behavior')->nullable(); 
            
            // Video Preview
            $table->string('video_url')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abilities');
    }
};