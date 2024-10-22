<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Podcast extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' , 'judul_podcast' , 'genre_podcast' , 'deskripsi_podcast', 'eps_podcast' , 'image_podcast' ,'date_podcast' , 'link_podcast' , 'file' , 'slug' ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Podcast $podcast) {
            // Cek jika ada nama file gambar
            if ($podcast->image_podcast) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($podcast->image_podcast);
            }
        });

        static::updating(function (Podcast $podcast) {
            // Cek jika ada gambar baru yang diupload
            if ($podcast->isDirty('image_podcast')) {
                // Ambil nama gambar lama
                $oldImage = $podcast->getOriginal('image_podcast');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}

