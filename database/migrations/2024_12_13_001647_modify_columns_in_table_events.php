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
            $table->text('deskripsi_event')->nullable()->change();
            $table->string('deskripsi_pendek')->nullable()->after('image_event');
            $table->string('ticket_url')->nullable()->after('status');
            $table->boolean('has_ticket')->default(false)->after('ticket_url');
            $table->string('slug')->after('has_ticket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->text('deskripsi_event')->nullable(false)->change();
            // Menghapus kolom yang telah ditambahkan di fungsi up
            $table->dropColumn(['nama_event', 'deskripsi_pendek' , 'ticket_url' , 'has_ticket' , 'slug']);
        });
    }
};
