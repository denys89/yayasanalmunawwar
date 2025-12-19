<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_registration_id',
        'admission_wave_id',
        'full_name',
        'nickname',
        'family_card_number',
        'national_id_number',
        'birthplace',
        'birthdate',
        'gender',
        'sibling_name',
        'sibling_class',
        'selected_class',
        'class_level',
        'registration_type',
        'previous_school_type',
        'previous_school_name',
        'status',
        'enrolled_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'enrolled_at' => 'datetime',
    ];

    /**
     * Get the student registration that created this student.
     */
    public function studentRegistration(): BelongsTo
    {
        return $this->belongsTo(StudentRegistration::class);
    }

    /**
     * Get the admission wave for this student.
     */
    public function admissionWave(): BelongsTo
    {
        return $this->belongsTo(AdmissionWave::class);
    }

    /**
     * Get the guardians for this student.
     */
    public function guardians(): HasMany
    {
        return $this->hasMany(StudentGuardian::class);
    }

    /**
     * Get the user who created this student.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this student.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope to filter active students.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to filter by class.
     */
    public function scopeByClass($query, string $class)
    {
        return $query->where('selected_class', $class);
    }

    /**
     * Scope to filter by admission wave.
     */
    public function scopeByAdmissionWave($query, int $waveId)
    {
        return $query->where('admission_wave_id', $waveId);
    }

    /**
     * Get the class label.
     */
    public function getClassLabelAttribute(): string
    {
        $labels = [
            'kb' => 'KB (Kelompok Bermain)',
            'tk' => 'TK (Taman Kanak-kanak)',
            'sd' => 'SD (Sekolah Dasar)',
        ];

        return $labels[$this->selected_class] ?? strtoupper($this->selected_class);
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'graduated' => 'Graduated',
        ];

        return $labels[$this->status] ?? ucfirst($this->status);
    }
}
