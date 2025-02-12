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
        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('link_youtube')->after('link_podcast')->nullable();
            $table->string('file_video')->after('file')->nullable();
            $table->string('file')->nullable()->change(); // Mengubah kolom file agar bisa null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->dropColumn(['link_youtube', 'file_video']);
            // Jika kolom 'file' sebelumnya tidak nullable, kembalikan ke wajib diisi
            $table->string('file')->nullable(false)->change();
        });
    }
};
