<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramTestimony extends Model
{
    use HasFactory;

    protected $table = 'program_testimonies';

    protected $fillable = [
        'program_id',
        'name',
        'education',
        'from',
        'ideal',
        'testimony',
        'photo',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
