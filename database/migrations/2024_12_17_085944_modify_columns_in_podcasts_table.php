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
            $table->json('genre_podcast')->after('judul_podcast');
            $table->boolean('publish_now')->default(true)->after('date_podcast');
            $table->date('tanggal_publikasi')->nullable()->after('publish_now');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            // $table->string('genre_podcast', 255)->after('judul_podcast')->change();
            $table->dropColumn('publish_now');
            $table->dropColumn('genre_podcast');
            $table->dropColumn('tanggal_publikasi');
        });
    }
};

