<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdmissionWave extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'registration_fee',
        'final_payment_fee',
        'start_date',
        'end_date',
        'is_active',
        'capacity',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'registration_fee' => 'integer',
        'final_payment_fee' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'capacity' => 'integer',
        'is_active' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who created this admission wave.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this admission wave.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the payments associated with this admission wave.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if the admission wave is currently active (within date range and is_active is true).
     */
    public function isActive(): bool
    {
        $now = time();
        return $this->is_active && $now >= $this->start_date && $now <= $this->end_date;
    }

    /**
     * Check if the admission wave is marked as active.
     */
    public function isMarkedActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Check if the admission wave is within its date range.
     */
    public function isWithinDateRange(): bool
    {
        $now = time();
        return $now >= $this->start_date && $now <= $this->end_date;
    }

    /**
     * Get the status label for display.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    /**
     * Get the status color for UI display.
     */
    public function getStatusColorAttribute(): string
    {
        return $this->is_active ? 'green' : 'gray';
    }

    /**
     * Get formatted start date.
     */
    public function getFormattedStartDateAttribute(): string
    {
        return date('Y-m-d H:i:s', $this->start_date);
    }

    /**
     * Get formatted end date.
     */
    public function getFormattedEndDateAttribute(): string
    {
        return date('Y-m-d H:i:s', $this->end_date);
    }

    /**
     * Scope for active admission waves.
     */
    public function scopeActive($query)
    {
        $now = time();
        return $query->where('is_active', true)
                    ->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    /**
     * Scope for admission waves by active status.
     */
    public function scopeByActiveStatus($query, $isActive)
    {
        return $query->where('is_active', $isActive);
    }

    /**
     * Scope for admission waves by level.
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }
}