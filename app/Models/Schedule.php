<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['program_id', 'nama_program', 'jam_program', 'hari', 'deskripsi'];

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
