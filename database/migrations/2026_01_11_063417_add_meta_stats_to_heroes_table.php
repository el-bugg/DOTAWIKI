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
        Schema::table('heroes', function (Blueprint $table) {
            // Cek satu per satu. Kalau kolom belum ada, baru dibuat.
            // Ini aman 100% dari error "Duplicate column"
            
            if (!Schema::hasColumn('heroes', 'pro_pick')) {
                $table->integer('pro_pick')->default(0);
            }

            if (!Schema::hasColumn('heroes', 'pro_ban')) {
                $table->integer('pro_ban')->default(0);
            }

            if (!Schema::hasColumn('heroes', 'pro_win')) {
                $table->integer('pro_win')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            // Kosongkan saja agar aman saat rollback
        });
    }
};