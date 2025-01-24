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
        Schema::table('popUp_ads', function (Blueprint $table) {
            $table->json('page')->after('images_ads'); // Judul popup
            $table->boolean('close_with_icon')->after('page')->default(false)->nullable(); // Default: bisa ditutup dengan ikon
            $table->boolean('close_with_click_anywhere')->after('close_with_icon')->default(true)->nullable();
            $table->enum('target_audience', ['new_users', 'all_users'])->after('close_with_click_anywhere')->default('all_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('popUp_ads', function (Blueprint $table) {
            $table->dropColumn(['page' , 'close_with_icon' , 'close_with_click_anywhere' , 'targer_audience']); // Menghapus kolom yang ditambahkan
        });
    }
};
