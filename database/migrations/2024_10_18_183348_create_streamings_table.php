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
        Schema::create('streamings', function (Blueprint $table) {
            $table->id();
            $table->string('title_stream' , 255);
            $table->string('stream_video_url');
            $table->string('stream_audio_url' );
            $table->string('image_stream' ,)->nullable();
            $table->enum('status',['streaming' ,'upcoming' ,'completed'])->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streamings');
    }
};
