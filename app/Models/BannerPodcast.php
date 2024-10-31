<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BannerPodcast extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id' , 'title_banner_podcast' , 'banner_podcast' ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (BannerPodcast $bannerpodcast) {
            // Cek jika ada nama file gambar
            if ($bannerpodcast->banner_podcast) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($bannerpodcast->banner_podcast);
            }
        });

        static::updating(function (BannerPodcast $bannerpodcast) {
            // Cek jika ada gambar baru yang diupload
            if ($bannerpodcast->isDirty('banner_podcast')) {
                // Ambil nama gambar lama
                $oldImage = $bannerpodcast->getOriginal('banner_podcast');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
