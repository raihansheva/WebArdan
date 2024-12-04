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
        Schema::table('infos', function (Blueprint $table) {
            $table->json('tag_info')->after('judul_info'); // Ubah tipe kolom menjadi JSON
        });
    }

    public function down(): void
    {
        Schema::table('infos', function (Blueprint $table) {
            $table->json('tag_info'); // Kembalikan ke string
        });
    }
};
