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
            $table->string('judul_berita')->nullable()->after('image_artis');
            $table->string('ringkasan_berita')->nullable()->after('judul_berita');
            $table->text('konten_berita')->nullable()->after('ringkasan_berita'); // Konten Berita
            $table->boolean('publish_sekarang')->default(true)->after('konten_berita'); // Opsi Publish Sekarang
            $table->date('tanggal_publikasi')->nullable()->after('publish_sekarang'); // Tanggal Publikasi (jika tidak sekarang)
            $table->date('tanggal_dibuat')->nullable()->after('tanggal_publikasi');
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
                'ringkasan_berita',
                'konten_berita',
                'publish_sekarang',
                'tanggal_publikasi',
                'tanggal_dibuat',
            ]);
        });
    }
};
