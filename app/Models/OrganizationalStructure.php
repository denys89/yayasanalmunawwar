<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationalStructure extends Model
{
    use HasFactory;

    protected $table = 'organizational_structure';

    protected $fillable = [
        'name',
        'title',
        'description',
        'banner',
        'image',
        'governance_principles',
        'quran_quote',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function foundationLeadershipStructures()
    {
        return $this->hasMany(FoundationLeadershipStructure::class);
    }

    public function islamicLeadershipValues()
    {
        return $this->hasMany(IslamicLeadershipValue::class);
    }
}