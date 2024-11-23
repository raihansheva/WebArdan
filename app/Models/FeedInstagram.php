<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedInstagram extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'instagram_link'];
}
