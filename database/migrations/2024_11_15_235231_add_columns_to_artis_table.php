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
            $table->string('judul_berita')->nullable()->after('image_artis'); // Judul Berita tentang Artis
            $table->text('konten_berita')->nullable()->after('judul_berita'); // Konten Berita
            $table->boolean('publish_sekarang')->default(true)->after('konten_berita'); // Opsi Publish Sekarang
            $table->date('tanggal_publikasi')->nullable()->after('publish_sekarang'); // Tanggal Publikasi (jika tidak sekarang)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artis', function (Blueprint $table) {
            $table->dropColumn([
                'judul_berita',
                'konten_berita',
                'publish_sekarang',
                'tanggal_publikasi',
            ]);
        });
    }
};
