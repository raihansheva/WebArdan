<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Program extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id', 'text_header', 'judul_program', 'deskripsi_program', 'jam_mulai', 'jam_selesai', 'image_program'];

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
}
