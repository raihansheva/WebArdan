<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannerYoutube extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id' , 'title_banner_youtube' , 'banner_youtube' ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (BannerYoutube $bannerYoutube) {
            // Cek jika ada nama file gambar
            if ($bannerYoutube->banner_youtube) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($bannerYoutube->banner_youtube);
            }
        });

        static::updating(function (BannerYoutube $bannerYoutube) {
            // Cek jika ada gambar baru yang diupload
            if ($bannerYoutube->isDirty('banner_youtube')) {
                // Ambil nama gambar lama
                $oldImage = $bannerYoutube->getOriginal('banner_youtube');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
