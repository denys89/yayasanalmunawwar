<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationLeadershipStructure extends Model
{
    use HasFactory;

    const TYPE_FOUNDATION = 'foundation';
    const TYPE_SCHOOL = 'school';

    protected $fillable = [
        'organizational_structure_id',
        'type',
        'photo',
        'title',
        'position',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function getTypes()
    {
        return [
            self::TYPE_FOUNDATION => 'Foundation',
            self::TYPE_SCHOOL => 'School',
        ];
    }

    public function organizationalStructure()
    {
        return $this->belongsTo(OrganizationalStructure::class);
    }

    public function scopeFoundationType($query)
    {
        return $query->where('type', self::TYPE_FOUNDATION);
    }

    public function scopeSchoolType($query)
    {
        return $query->where('type', self::TYPE_SCHOOL);
    }
}