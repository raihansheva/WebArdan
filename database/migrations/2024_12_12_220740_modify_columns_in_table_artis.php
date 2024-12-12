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
        Schema::table('artis', function (Blueprint $table) {
            $table->renameColumn('bio', 'kategori_info');
            $table->string('slug')->nullable()->after('judul_berita'); // Kolom meta title
            $table->string('meta_title')->nullable()->after('tanggal_dibuat'); // Kolom meta title
            $table->text('meta_description')->nullable()->after('meta_title'); // Kolom meta description
            $table->string('meta_keywords')->nullable()->after('meta_description'); // Kolom meta keywords
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artis', function (Blueprint $table) {
            // Mengembalikan nama kolom 'kategori_info' menjadi 'bio'
            $table->renameColumn('kategori_info', 'bio');
            
            // Menghapus kolom yang telah ditambahkan di fungsi up
            $table->dropColumn(['slug', 'meta_title', 'meta_description', 'meta_keywords']);
        });
    }
};
