<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Explore extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'image_url',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope for filtering by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get facilities
     */
    public function scopeFacilities($query)
    {
        return $query->where('category', 'facility');
    }

    /**
     * Get extracurriculars
     */
    public function scopeExtracurriculars($query)
    {
        return $query->where('category', 'extracurricular');
    }
}
