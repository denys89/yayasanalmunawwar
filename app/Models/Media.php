<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_url',
        'type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope for images
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Scope for videos
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Scope for PDFs
     */
    public function scopePdfs($query)
    {
        return $query->where('type', 'pdf');
    }
}
