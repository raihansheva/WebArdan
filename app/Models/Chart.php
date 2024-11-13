<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chart extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'name' , 'link_audio' , 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class , 'kategori_id');
    }

    protected static function boot()
    {
        parent::boot();
    
        // Event saat data dihapus
        static::deleting(function ($chart) {
            if ($chart->link_audio && Storage::disk('public')->exists($chart->link_audio)) {
                Storage::disk('public')->delete($chart->link_audio); // Menghapus file audio dari storage
            }
        });
    
        // Event saat data diperbarui
        static::updating(function ($chart) {
            if ($chart->isDirty('link_audio')) { // Memeriksa apakah field 'link_audio' berubah
                $oldAudio = $chart->getOriginal('link_audio'); // Mendapatkan file audio lama
                if ($oldAudio && Storage::disk('public')->exists($oldAudio)) {
                    Storage::disk('public')->delete($oldAudio); // Menghapus file audio lama dari storage
                }
            }
        });
    }
    
}
