<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Program extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id',
        'judul_program',
        'deskripsi_pendek',
        'deskripsi_program',
        'jam_mulai',
        'jam_selesai',
        'image_program',
        'publish_now',
        'tanggal_publikasi',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function getJamMulaiAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getJamSelesaiAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Program $program) {
            // Cek jika ada nama file gambar
            if ($program->image_program) {
                // Hapus file gambar dari disk publik
                Storage::disk('public')->delete($program->image_program);
            }
        });

        static::updating(function (Program $program) {
            // Cek jika ada gambar baru yang diupload
            if ($program->isDirty('image_program')) {
                // Ambil nama gambar lama
                $oldImage = $program->getOriginal('image_program');

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
