<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Info extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    protected $fillable = [
        'id',
        'judul_info',
        'kategori_id',
        'tag_info',
        'deskripsi_info',
        'image_info',
        'date_info',
        'publish_now',
        'tanggal_publikasi',
        'top_news',
        'trending',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'tag_info' => 'array', // Konversi JSON ke array
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Info $info) {
            // Cek jika ada nama file gambar
            if ($info->image_info) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($info->image_info);
            }
        });

        static::updating(function (Info $info) {
            // Cek jika ada gambar baru yang diupload
            if ($info->isDirty('image_info')) {
                // Ambil nama gambar lama
                $oldImage = $info->getOriginal('image_info');

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

    public function tagInfo(): BelongsTo
    {
        return $this->belongsTo(TagInfo::class, 'kategori_id');
    }
}
