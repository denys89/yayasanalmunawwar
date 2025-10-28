<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Homepage extends Model
{
    use HasFactory;

    protected $table = 'homepage';

    protected $fillable = [
        'title',
        'description',
        'photo',
        'photo_title',
        'youtube_embed',
    ];

    /**
     * Get the foundation values related to the homepage.
     */
    public function foundationValues(): HasMany
    {
        return $this->hasMany(FoundationValue::class);
    }
}