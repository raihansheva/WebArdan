<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('page')->after('image_banner'); // Menyimpan nama halaman
            $table->string('position')->after('page');    // Menyimpan posisi (top, middle, bottom)
            $table->string('width_type')->default('full')->after('position');
        });
    }
    
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['page', 'position' , 'width_type']);
        });
    }
};
