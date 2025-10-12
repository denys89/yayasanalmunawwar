<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'curriculum',
        'brochure_url',
        'phone',
        'email',
        'address',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function facilities()
    {
        return $this->hasMany(ProgramFacility::class);
    }

    public function educations()
    {
        return $this->hasMany(ProgramEducation::class);
    }
}
