<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BannerInfo extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id' , 'title_banner_info' , 'banner_info' ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (BannerInfo $BannerInfo) {
            // Cek jika ada nama file gambar
            if ($BannerInfo->banner_info) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($BannerInfo->banner_info);
            }
        });

        static::updating(function (BannerInfo $BannerInfo) {
            // Cek jika ada gambar baru yang diupload
            if ($BannerInfo->isDirty('banner_info')) {
                // Ambil nama gambar lama
                $oldImage = $BannerInfo->getOriginal('banner_info');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
