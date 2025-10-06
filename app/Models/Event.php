<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getFormattedDatetimeAttribute(): string
    {
        $dt = $this->datetime instanceof \Illuminate\Support\Carbon ? $this->datetime : Carbon::parse($this->datetime);
        return $dt->format('l, d M Y \a\t H:i');
    }
}