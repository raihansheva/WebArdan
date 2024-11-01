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
        Schema::create('copy_rights', function (Blueprint $table) {
            $table->id();
            $table->string('text' , 255);
            $table->string('copyright_owners' , 255);
            $table->string('link_company' , 255);
            $table->year('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_rights');
    }
};
