<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'show_in_menu',
        'menu_order',
        'is_published',
        'published_at',
        'type',
        'status',
    ];

    protected $casts = [
        'show_in_menu' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Check if page is published
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Scope for published pages
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for draft pages
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
