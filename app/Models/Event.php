<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'nama_event',
        'image_event',
        'deskripsi_pendek',
        'deskripsi_event',
        'date_event',
        'publish_now',
        'tanggal_publikasi',
        'time_countdown',
        'status',
        'ticket_url',
        'has_ticket',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

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

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->publish_now) {
                $model->tanggal_publikasi = now(); // Atur tanggal_publikasi ke waktu saat ini
            }

            if ($model->tanggal_publikasi && Carbon::now()->gte(Carbon::parse($model->tanggal_publikasi))) {
                $model->publish_now = true;
            }
        });
    }

    public function getIsPublishedAttribute(): bool
    {
        if ($this->publish_now) {
            return true; // Publish immediately
        }

        if ($this->tanggal_publikasi && Carbon::now()->gte(Carbon::parse($this->tanggal_publikasi))) {
            return true; // Publish if tanggal_publikasi has passed
        }

        return false; // Not published
    }
}
