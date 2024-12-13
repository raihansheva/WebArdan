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
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('text_header');
            $table->text('deskripsi_pendek')->after('judul_program');
            $table->string('slug')->after('image_program');
            $table->string('meta_title')->nullable()->after('slug'); // Kolom meta title
            $table->text('meta_description')->nullable()->after('meta_title'); // Kolom meta description
            $table->string('meta_keywords')->nullable()->after('meta_description'); // Kolom meta keywords
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            // Tambahkan kembali kolom text_header
            $table->text('text_header')->nullable()->after('id');

            // Hapus kolom yang ditambahkan pada up()
            $table->dropColumn(['slug', 'deskripsi_pendek' , 'meta_title' , 'meta_description' , 'meta_keywords']);
        });
    }
};
