<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExploreImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'explore_id',
        'image_url',
        'caption',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function explore()
    {
        return $this->belongsTo(Explore::class);
    }
}