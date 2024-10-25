<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'name' , 'link_audio' , 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class , 'kategori_id');
    }
}
