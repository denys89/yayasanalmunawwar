<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoundationValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'homepage_id',
        'icon',
        'title',
        'description',
    ];

    /**
     * Get the homepage that this value belongs to.
     */
    public function homepage(): BelongsTo
    {
        return $this->belongsTo(Homepage::class);
    }
}