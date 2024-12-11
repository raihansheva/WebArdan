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
        Schema::table('kategori_infos', function (Blueprint $table) {
            $table->renameColumn('nama_tag', 'nama_kategori');

            // Tambahkan kolom baru
            $table->boolean('is_visible')->default(false)->after('nama_kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_infos', function (Blueprint $table) {
            $table->renameColumn('nama_kategori', 'nama_tag');

            // Hapus kolom yang ditambahkan
            $table->dropColumn('is_visible');
        });
    }
};
