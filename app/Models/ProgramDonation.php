<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramDonation extends Model
{
    use HasFactory;

    protected $table = 'program_donations';

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