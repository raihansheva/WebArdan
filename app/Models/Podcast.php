<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Podcast extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'judul_podcast',
        'genre_podcast',
        'deskripsi_podcast',
        'image_podcast',
        'date_podcast',
        'publish_now',
        'tanggal_publikasi',
        'link_podcast',
        'file',
        'slug',
        'episode_number',
        'is_episode',
        'podcast_id',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'genre_podcast' => 'array', // Konversi JSON ke array
    ];

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

    public function episodes()
    {
        return $this->hasMany(Podcast::class, 'podcast_id')->where('is_episode', true)->orderBy('episode_number');
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class, 'podcast_id');
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
