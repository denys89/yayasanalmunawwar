<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'student_registration_id',
        'admission_wave_id',
        'level',
        'amount',
        'type',
        'status',
        'foto_bukti_transfer',
        'discount_id',
        'confirmed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the student registration that owns the payment.
     */
    public function studentRegistration(): BelongsTo
    {
        return $this->belongsTo(StudentRegistration::class);
    }

    /**
     * Get the admission wave that owns the payment.
     */
    public function admissionWave(): BelongsTo
    {
        return $this->belongsTo(AdmissionWave::class);
    }

    /**
     * Get the discount applied to the payment.
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * Get the user who confirmed the payment.
     */
    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    /**
     * Scope to filter by payment type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to filter by payment status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Check if payment is paid.
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Check if payment can be marked as paid.
     */
    public function canBeMarkedAsPaid(): bool
    {
        return in_array($this->status, ['unpaid', 'pending']);
    }

    /**
     * Mark payment as paid by a user.
     */
    public function markAsPaid(User $user): bool
    {
        if (!$this->canBeMarkedAsPaid()) {
            return false;
        }

        $this->update([
            'status' => 'paid',
            'confirmed_by' => $user->id,
        ]);

        return true;
    }
}
