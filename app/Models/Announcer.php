<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;

class Announcer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id', 'name_announcer', 'image_announcer', 'link_instagram', 'link_tiktok', 'link_twitter', 'bio'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function (Announcer $announcer) {
    //         // Cek jika ada nama file gambar
    //         if ($announcer->image_announcer) {
    //             // Hapus file gambar dari disk publik
    //             Storage::disk('public')->delete($announcer->image_announcer);
    //         }
    //     });

    //     static::updating(function (Announcer $announcer) {
    //         // Cek jika ada gambar baru yang diupload
    //         if ($announcer->isDirty('image_announcer')) {
    //             // Ambil nama gambar lama
    //             $oldImage = $announcer->getOriginal('image_announcer');

    //             // Hapus gambar lama
    //             if ($oldImage) {
    //                 Storage::disk('public')->delete($oldImage);
    //             }
    //         }
    //     });
    // }

    protected static function boot()
    {
        parent::boot();

        // Event saat data diperbarui
        static::updating(function (Announcer $announcer) {
            if ($announcer->isDirty('image_announcer')) {
                // Gambar lama
                $oldImage = $announcer->getOriginal('image_announcer');

                // Hapus gambar lama jika ada
                if ($oldImage) {
                    $oldImagePath = public_path('uploads/images_announcer/' . $oldImage);

                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath); // Hapus file
                    }
                }
            }
        });

        // Event saat data dihapus
        static::deleting(function (Announcer $announcer) {
            if ($announcer->image_announcer) {
                $imagePath = public_path('uploads/images_announcer/' . $announcer->image_announcer);

                if (File::exists($imagePath)) {
                    File::delete($imagePath); // Hapus file
                }
            }
        });
    }
}
