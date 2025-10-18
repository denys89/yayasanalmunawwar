<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'banner_image',
        'datetime',
        'location',
        'organizer',
        'contact',
        'description',
        'summary',
        'status',
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getFormattedDatetimeAttribute()
    {
        return $this->datetime ? $this->datetime->format('d M Y H:i') : null;
    }
}