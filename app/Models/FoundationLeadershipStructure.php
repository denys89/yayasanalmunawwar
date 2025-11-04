<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationLeadershipStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizational_structure_id',
        'photo',
        'title',
        'position',
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