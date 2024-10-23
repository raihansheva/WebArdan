<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' , 'image_event' , 'deskripsi_event' , 'date_event' , 'time_countdown' , 'status'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Event $event) {
            // Cek jika ada nama file gambar
            if ($event->image_event) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($event->image_event);
            }
        });

        static::updating(function (Event $event) {
            // Cek jika ada gambar baru yang diupload
            if ($event->isDirty('image_event')) {
                // Ambil nama gambar lama
                $oldImage = $event->getOriginal('image_event');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }

}
