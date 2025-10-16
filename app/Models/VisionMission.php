<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    use HasFactory;

    protected $table = 'vision_mission';

    protected $fillable = [
        'name',
        'title',
        'description',
        'banner',
        'image',
        'our_vision',
        'quran_quote',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function coreValues()
    {
        return $this->hasMany(CoreValue::class);
    }
}