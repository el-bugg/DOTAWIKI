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
        // Hapus kolom jika sudah ada (untuk membersihkan data string tadi)
        if (Schema::hasColumn('heroes', 'pro_ban')) {
            $table->dropColumn(['pro_pick', 'pro_ban', 'pro_win']);
        }
    });

    Schema::table('heroes', function (Blueprint $table) {
        // Buat ulang dengan tipe data integer yang benar
        $table->integer('pro_pick')->default(0);
        $table->integer('pro_ban')->default(0);
        $table->integer('pro_win')->default(0);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            //
        });
    }
};
