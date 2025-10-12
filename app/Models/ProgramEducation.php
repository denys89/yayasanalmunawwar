<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramEducation extends Model
{
    use HasFactory;

    protected $table = 'program_educations';

    protected $fillable = [
        'program_id',
        'icon',
        'name',
        'description',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}