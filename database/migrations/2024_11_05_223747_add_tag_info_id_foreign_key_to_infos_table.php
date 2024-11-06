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
            $table->unsignedBigInteger('tag_info_id')->after('judul_info')->nullable();
            $table->foreign('tag_info_id')->references('id')->on('tag_infos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('infos', function (Blueprint $table) {
            $table->dropForeign(['tag_info_id']);
            $table->dropColumn('tag_info_id');
        });
    }
};
