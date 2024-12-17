<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artis extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'nama',
        'kategori_info',
        'image_artis',
        'judul_berita',
        'slug',
        'ringkasan_berita',
        'konten_berita',
        'publish_sekarang',
        'tanggal_dibuat',
        'tanggal_publikasi',
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

        static::deleting(function (Artis $artis) {
            // Cek jika ada nama file gambar
            if ($artis->image_artis) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($artis->image_artis);
            }
        });

        static::updating(function (Artis $artis) {
            // Cek jika ada gambar baru yang diupload
            if ($artis->isDirty('image_artis')) {
                // Ambil nama gambar lama
                $oldImage = $artis->getOriginal('image_artis');

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
            if ($model->publish_sekarang) {
                $model->tanggal_publikasi = now(); // Atur tanggal_publikasi ke waktu saat ini
            }

            if ($model->tanggal_publikasi && Carbon::now()->gte(Carbon::parse($model->tanggal_publikasi))) {
                $model->publish_sekarang = true;
            }
        });
    }

    public function getIsPublishedAttribute(): bool
    {
        if ($this->publish_sekarang) {
            return true; // Publish immediately
        }

        if ($this->tanggal_publikasi && Carbon::now()->gte(Carbon::parse($this->tanggal_publikasi))) {
            return true; // Publish if tanggal_publikasi has passed
        }

        return false; // Not published
    }

    
}

