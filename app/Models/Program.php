<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['id' ,'text_header' , 'judul_program' ,'deskripsi_program' , 'jam_program' , 'image_program'];
    

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
