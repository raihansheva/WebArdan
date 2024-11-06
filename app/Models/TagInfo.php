<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagInfo extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama_tag'];


    public function info()
    {
        return $this->hasMany(Info::class, 'tag_info_id');
    }
}
