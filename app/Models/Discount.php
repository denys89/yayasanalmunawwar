<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'type',
        'level',
        'admission_wave_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'amount' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the admission wave that owns the discount.
     */
    public function admissionWave(): BelongsTo
    {
        return $this->belongsTo(AdmissionWave::class);
    }

    /**
     * Get the user who created this discount.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this discount.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the payments that use this discount.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope for filtering by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for filtering by level
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Scope for filtering by admission wave
     */
    public function scopeByAdmissionWave($query, $admissionWaveId)
    {
        return $query->where('admission_wave_id', $admissionWaveId);
    }

    /**
     * Get internal discounts
     */
    public function scopeInternal($query)
    {
        return $query->where('type', 'internal');
    }

    /**
     * Get early bird discounts
     */
    public function scopeEarlyBird($query)
    {
        return $query->where('type', 'early_bird');
    }

    /**
     * Get other discounts
     */
    public function scopeOther($query)
    {
        return $query->where('type', 'other');
    }
}
