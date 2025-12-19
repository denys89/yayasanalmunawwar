<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class MonthlyPayment extends Model
{
    protected $fillable = [
        'student_id',
        'payment_period',
        'payment_month',
        'payment_year',
        'amount',
        'status',
        'proof_url',
        'proof_uploaded_at',
        'due_date',
        'paid_at',
        'confirmed_by',
        'confirmed_at',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_month' => 'integer',
        'payment_year' => 'integer',
        'due_date' => 'date',
        'paid_at' => 'date',
        'proof_uploaded_at' => 'datetime',
        'confirmed_at' => 'datetime',
    ];

    /**
     * Get the student that owns the payment.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the user who confirmed the payment.
     */
    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    /**
     * Scope to filter by payment period.
     */
    public function scopeForPeriod($query, string $period)
    {
        return $query->where('payment_period', $period);
    }

    /**
     * Scope to filter by status.
     */
    public function scopeWithStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter by year.
     */
    public function scopeForYear($query, int $year)
    {
        return $query->where('payment_year', $year);
    }

    /**
     * Scope to filter by month.
     */
    public function scopeForMonth($query, int $month)
    {
        return $query->where('payment_month', $month);
    }

    /**
     * Check if payment is overdue.
     */
    public function isOverdue(): bool
    {
        return $this->status !== 'paid' && $this->due_date < now();
    }

    /**
     * Check if payment is paid.
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Check if payment is pending confirmation.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Mark payment as paid.
     */
    public function markAsPaid(User $user, ?string $notes = null): bool
    {
        return $this->update([
            'status' => 'paid',
            'paid_at' => now(),
            'confirmed_by' => $user->id,
            'confirmed_at' => now(),
            'notes' => $notes,
        ]);
    }

    /**
     * Get formatted period name.
     */
    public function getPeriodNameAttribute(): string
    {
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        return $months[$this->payment_month] . ' ' . $this->payment_year;
    }

    /**
     * Update overdue status automatically.
     */
    public function updateOverdueStatus(): void
    {
        if ($this->isOverdue() && $this->status === 'unpaid') {
            $this->update(['status' => 'overdue']);
        }
    }
}
