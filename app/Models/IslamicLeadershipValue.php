<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslamicLeadershipValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizational_structure_id',
        'icon',
        'title',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function organizationalStructure()
    {
        return $this->belongsTo(OrganizationalStructure::class);
    }
}