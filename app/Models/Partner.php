<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' , 'name_partner' , 'logo_partner'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Partner $partner) {
            // Cek jika ada nama file gambar
            if ($partner->logo_partner) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($partner->logo_partner);
            }
        });

        static::updating(function (Partner $partner) {
            // Cek jika ada gambar baru yang diupload
            if ($partner->isDirty('logo_partner')) {
                // Ambil nama gambar lama
                $oldImage = $partner->getOriginal('logo_partner');

                // Hapus gambar lama
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
