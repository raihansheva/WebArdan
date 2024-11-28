<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['program_id', 'nama_program', 'jam_mulai' , 'jam_selesai', 'hari', 'deskripsi'];
    
    public function getJamMulaiAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getJamSelesaiAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function setJamProgramAttribute($value)
    {
        if (!$value && $this->program) {
            $this->attributes['jam_program'] = $this->program->jam_program;
        } else {
            $this->attributes['jam_program'] = $value;
        }
    }
}
