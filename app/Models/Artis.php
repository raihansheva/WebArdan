<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artis extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' , 'nama' , 'bio' ,'image_artis', 'judul_berita', 'konten_berita' , 'publish_sekarang' , 'tanggal_publikasi'];


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

}
