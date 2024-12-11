<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagInfo extends Model
{
    use HasFactory;

    protected $table = 'kategori_infos';

    protected $fillable = ['id', 'nama_kategori' , 'is_visible'];


    public function info()
    {
        return $this->hasMany(Info::class , 'id');
    }
}
