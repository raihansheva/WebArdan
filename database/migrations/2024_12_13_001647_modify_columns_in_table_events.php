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
        Schema::table('events', function (Blueprint $table) {
            $table->string('nama_event')->nullable()->after('id'); // Kolom meta title
            $table->string('deskripsi_pendek')->nullable()->after('image_event'); // Kolom meta title
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Menghapus kolom yang telah ditambahkan di fungsi up
            $table->dropColumn(['nama_event', 'deskripsi_pendek']);
        });
    }
};
