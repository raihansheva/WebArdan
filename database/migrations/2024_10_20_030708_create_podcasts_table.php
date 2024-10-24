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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('judul_podcast' , 255);
            $table->string('genre_podcast' , 255);
            $table->text('deskripsi_podcast');
            $table->string('image_podcast');
            $table->date('date_podcast');
            $table->string('link_podcast');
            $table->string('file');
            $table->string('slug')->unique();
            $table->integer('episode_number')->nullable(); 
            $table->boolean('is_episode')->default(false); 
            $table->unsignedBigInteger('podcast_id')->nullable(); 
            $table->timestamps();

            $table->foreign('podcast_id')->references('id')->on('podcasts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
