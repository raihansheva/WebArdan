<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Info extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;


    protected $fillable = ['id' , 'judul_info' , 'tag_info' , 'deskripsi_info' , 'image_info' , 'date_info' , 'top_news', 'trending' , 'slug'];

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

    // public function tagInfo(): BelongsTo
    // {
    //     return $this->belongsTo(TagInfo::class, 'tag_info_id');
    // }
}
