<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            // Baris 'image' SAYA HAPUS karena sudah ada di database (penyebab error)
            
            // Kita coba tambahkan 'video' saja.
            // Kita pakai check if (hasColumn) biar aman 100% dan tidak error lagi
            if (!Schema::hasColumn('posts', 'video')) {
                $table->string('video')->nullable()->after('content');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'video')) {
                $table->dropColumn('video');
            }
        });
    }
};