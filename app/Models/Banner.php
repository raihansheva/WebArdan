<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' , 'title_banner' , 'image_banner'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Banner $banner) {
            // Cek jika ada nama file gambar
            if ($banner->image_banner) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($banner->image_banner);
            }
        });

        static::updating(function (Banner $banner) {
            // Cek jika ada gambar baru yang diupload
            if ($banner->isDirty('image_banner')) {
                // Ambil nama gambar lama
                $oldImage = $banner->getOriginal('image_banner');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
