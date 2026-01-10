<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Update Tabel Items (Cek dulu biar tidak error duplicate)
        Schema::table('items', function (Blueprint $table) {
            
            if (!Schema::hasColumn('items', 'category')) {
                $table->string('category')->default('basic')->after('name'); 
            }
            
            if (!Schema::hasColumn('items', 'price')) {
                $table->integer('price')->default(0)->after('category');
            }

            if (!Schema::hasColumn('items', 'attributes')) {
                $table->json('attributes')->nullable()->after('price');
            }

            if (!Schema::hasColumn('items', 'recipe')) {
                $table->text('recipe')->nullable()->after('attributes');
            }

            if (!Schema::hasColumn('items', 'passive_effect')) {
                $table->text('passive_effect')->nullable()->after('recipe'); 
            }
        });

        // 2. Buat Tabel Hero Builds (Cek dulu biar tidak error exists)
        if (!Schema::hasTable('hero_builds')) {
            Schema::create('hero_builds', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('hero_id')->constrained()->onDelete('cascade');
                $table->string('title'); 
                $table->json('items_json'); 
                $table->integer('votes')->default(0); 
                $table->timestamps();
            });
        }
    }
};