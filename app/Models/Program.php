<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'slug',
        'description',
        'summary',
        'status',
        'curriculum',
        'brochure_url',
        'banner_url',
        'photo_url',
        'photo_description',
        'program_type',
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

    public function services()
    {
        return $this->hasMany(ProgramService::class);
    }

    public function donations()
    {
        return $this->hasMany(ProgramDonation::class);
    }

    public function activities()
    {
        return $this->hasMany(ProgramActivity::class);
    }
}
