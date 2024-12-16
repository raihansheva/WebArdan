<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Livewire\after;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('streamings', function (Blueprint $table) {
            $table->dropColumn('stream_audio_url');
            $table->dropColumn('stream_video_url');
            $table->dropColumn('status');
            $table->renameColumn('title_stream', 'type_url');
            $table->string('stream_url')->after('type_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('streamings', function (Blueprint $table) {
            // Tambahkan kembali kolom yang dihapus
        $table->string('stream_audio_url')->nullable();
        $table->string('stream_video_url')->nullable();
        $table->boolean('status')->default(0);

        // Kembalikan nama kolom yang diubah
        $table->renameColumn('type_url', 'title_stream');

        // Hapus kolom yang baru ditambahkan
        $table->dropColumn('stream_url');
        });
    }
};
