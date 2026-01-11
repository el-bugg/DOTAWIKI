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
        // Menambahkan kolom match_data tipe JSON yang boleh kosong
        $table->json('match_data')->nullable()->after('category');

        // Sekalian update kolom image/video biar tidak error kalau kosong
        $table->string('image')->nullable()->change();
        $table->string('video')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn('match_data');
    });
}
};
