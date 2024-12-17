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
            $table->boolean('publish_now')->default(true)->after('image_program');
            $table->date('tanggal_publikasi')->nullable()->after('publish_now');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('publish_now');
            $table->dropColumn('tanggal_publikasi');
        });
    }
};
