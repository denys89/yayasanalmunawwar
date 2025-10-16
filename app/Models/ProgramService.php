<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramService extends Model
{
    use HasFactory;

    protected $table = 'program_services';

    protected $fillable = [
        'program_id',
        'fa_icon',
        'name',
        'description',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}