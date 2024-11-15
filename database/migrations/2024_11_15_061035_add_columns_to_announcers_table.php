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
        Schema::table('announcers', function (Blueprint $table) {
            $table->text('bio')->nullable();
            $table->text('shows_hosted')->nullable();
            $table->text('availability_schedule')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcers', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'shows_hosted',
                'availability_schedule',
            ]);
        });
    }
};
