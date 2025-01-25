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
            if (Schema::hasColumn('popUp_ads', 'message')) {
                $table->dropColumn('message');
            }

            $table->string('link_ads')->after('title'); // Menambahkan ulang kolom message dengan nama link_ads

            $table->json('page')->after('images_ads'); // Judul popup
            $table->boolean('close_with_icon')->after('page')->default(false)->nullable(); // Default: bisa ditutup dengan ikon
            $table->boolean('close_with_click_anywhere')->after('close_with_icon')->default(true)->nullable();
            $table->enum('target_audience', ['new_users', 'all_users'])->after('close_with_click_anywhere')->default('all_users');
            $table->boolean('has_button')->after('target_audience')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('popUp_ads', function (Blueprint $table) {

            if (Schema::hasColumn('popUp_ads', 'link_ads')) {
                $table->dropColumn('link_ads');
            }

            if (!Schema::hasColumn('popUp_ads', 'message')) {
                $table->text('message')->after('title'); // Mengembalikan kolom message dengan tipe text
            }
            $table->dropColumn(['page', 'close_with_icon', 'close_with_click_anywhere', 'target_audience']); // Menghapus kolom yang ditambahkan
        });
    }
};
