<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Streaming extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id', 'type_url', 'stream_url', 'image_stream'];

    // Event saat model di-update
    // public static function boot()
    // {
    //     parent::boot();

    //     // Menghapus gambar lama saat model di-update
    //     static::updating(function ($stream) {
    //         if ($stream->isDirty('image')) { // Jika kolom 'image' diubah
    //             Storage::disk('public')->delete($stream->getOriginal('image'));
    //         }
    //     });

    //     // Menghapus gambar saat model dihapus
    //     static::deleting(function ($stream) {
    //         Storage::disk('public')->delete($stream->image);
    //     });
    // }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Streaming $stream) {
            // Cek jika ada nama file gambar
            if ($stream->image_stream) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($stream->image_stream);
            }
        });

        static::updating(function (Streaming $stream) {
            // Cek jika ada gambar baru yang diupload
            if ($stream->isDirty('image_stream')) {
                // Ambil nama gambar lama
                $oldImage = $stream->getOriginal('image_stream');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
