<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

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
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
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

    /**
     * Get the user who created the news.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the news.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
