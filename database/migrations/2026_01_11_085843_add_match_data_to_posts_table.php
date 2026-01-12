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
        Schema::table('posts', function (Blueprint $table) {
            // PERBAIKAN: Cek dulu apakah kolom 'match_data' sudah ada.
            // Jika belum ada, baru dibuat. Jika sudah ada, lewati.
            if (!Schema::hasColumn('posts', 'match_data')) {
                $table->json('match_data')->nullable()->after('category');
            }

            // CATATAN: Bagian ->change() untuk image/video saya hapus.
            // Alasannya: SQLite di Render sering error jika kita mengubah kolom yang sudah ada.
            // Biarkan saja seperti settingan awal (biasanya sudah nullable dari awal).
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'match_data')) {
                $table->dropColumn('match_data');
            }
        });
    }
};