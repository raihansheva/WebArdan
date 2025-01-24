<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;

class PopupAds extends Model
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' , 'title' , 'message' , 'image_ratio' , 'images_ads' , 'page' , 'close_with_icon' , 'close_with_click_anywhere', 'target_audience' , 'start_date', 'end_date' , 'start_time' , 'end_time'];


    protected $casts = [
        'page' => 'array', // Konversi JSON ke arrayb
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (PopupAds $popupAds) {
            // Cek jika ada nama file gambar
            if ($popupAds->image_ads) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($popupAds->image_ads);
            }
        });

        static::updating(function (PopupAds $popupAds) {
            // Cek jika ada gambar baru yang diupload
            if ($popupAds->isDirty('image_ads')) {
                // Ambil nama gambar lama
                $oldImage = $popupAds->getOriginal('image_ads');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
