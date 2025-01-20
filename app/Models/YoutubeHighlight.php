<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeHighlight extends Model
{
    use HasFactory;

    protected $table = 'youtube_highlight';

    protected $fillable = ['id', 'link_video' , 'page'];
}
