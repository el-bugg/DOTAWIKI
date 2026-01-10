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
    Schema::table('items', function (Blueprint $table) {
        // Kategori: 'basic' (mentah), 'upgrade' (jadi), 'consumable' (habis pakai)
        $table->string('category')->default('basic')->after('name'); 
        $table->integer('price')->default(0)->after('category');
        $table->json('attributes')->nullable()->after('price'); // Contoh: {"damage": 10, "strength": 5}
        $table->text('passive_effect')->nullable()->after('attributes'); // Deskripsi efek pasif
        $table->text('active_effect')->nullable()->after('passive_effect'); // Deskripsi efek aktif (jika ada)
        // Kolom 'components' sudah Anda miliki di model, asumsikan kolomnya ada di DB sebagai JSON
    });
}

public function down()
{
    Schema::table('items', function (Blueprint $table) {
        $table->dropColumn(['category', 'price', 'recipe', 'attributes', 'passive_effect']);
    });
}
};
