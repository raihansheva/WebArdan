<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyRight extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'text' , 'year' , 'copyright_owners' , 'link_company'];
}
