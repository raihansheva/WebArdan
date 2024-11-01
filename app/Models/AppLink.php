<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AppLink extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' , 'platform_name' , 'app_name' , 'app_image' , 'link_app'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (AppLink $appLink) {
            // Cek jika ada nama file gambar
            if ($appLink->app_image) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($appLink->app_image);
            }
        });

        static::updating(function (AppLink $appLink) {
            // Cek jika ada gambar baru yang diupload
            if ($appLink->isDirty('app_image')) {
                // Ambil nama gambar lama
                $oldImage = $appLink->getOriginal('app_image');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
