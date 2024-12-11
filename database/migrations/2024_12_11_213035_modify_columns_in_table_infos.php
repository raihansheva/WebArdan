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
        Schema::table('infos', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->after('judul_info')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategori_infos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('infos', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
