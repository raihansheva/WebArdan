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
            $table->id();
            $table->string('title'); // Judul popup
            $table->text('message'); // Pesan yang ditampilkan dalam popup
            $table->enum('image_ratio', ['landscape', 'portrait'])->default('landscape');
            $table->string('images_ads');
            $table->date('start_date'); // Tanggal mulai
            $table->date('end_date'); // Tanggal berakhir
            $table->time('start_time'); // Jam mulai
            $table->time('end_time'); // Jam selesai
            $table->timestamps();

            $table->dropColumn('tes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    
        Schema::dropIfExists('popUp_ads');
    }
};
