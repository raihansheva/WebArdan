<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['key', 'value'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo');
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Setting $setting) {
            // Cek jika ada perubahan pada value (yang berisi path logo)
            if ($setting->isDirty('value')) {
                // Ambil nama file logo lama dari media library
                $oldMediaPath = $setting->getOriginal('value');

                // Hapus file logo lama dari storage jika ada
                if ($oldMediaPath) {
                    // Pastikan file lama dihapus menggunakan Storage Laravel
                    Storage::disk('public')->delete($oldMediaPath);
                }

                // Hapus media dari Spatie jika ada
                if ($setting->hasMedia('logo')) {
                    $setting->clearMediaCollection('logo'); // Hapus semua media di koleksi 'logos'
                }
            }
        });

        static::deleting(function (Setting $setting) {
            // Hapus media (logo) ketika setting dihapus
            if ($setting->hasMedia('logo')) {
                $setting->clearMediaCollection('logo');
            }
        });
    }
}
