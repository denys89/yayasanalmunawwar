<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'image_url',
        'published_at',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Check if news is published
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Scope for published news
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for events
     */
    public function scopeEvents($query)
    {
        return $query->where('category', 'event');
    }

    /**
     * Scope for news
     */
    public function scopeNews($query)
    {
        return $query->where('category', 'news');
    }
}
