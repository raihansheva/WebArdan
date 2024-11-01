<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'text_1' , 'text_2' , 'email_collab', 'email_music' , 'no_telepon' , 'alamat'];
    
}
