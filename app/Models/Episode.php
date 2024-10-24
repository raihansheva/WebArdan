<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['id' ,'podcast_id' , 'judul_episode' , 'episode_number'];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
