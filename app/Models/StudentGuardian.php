<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentGuardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'type',
        'name',
        'job',
        'company',
        'email',
        'phone',
        'address',
    ];

    /**
     * Get the student that owns this guardian.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the type label.
     */
    public function getTypeLabelAttribute(): string
    {
        $labels = [
            'father' => 'Father',
            'mother' => 'Mother',
            'guardian' => 'Guardian',
        ];

        return $labels[$this->type] ?? ucfirst($this->type);
    }
}
