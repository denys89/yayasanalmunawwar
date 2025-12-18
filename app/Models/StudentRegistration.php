<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Payment;

class StudentRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'nickname',
        'family_card_number',
        'national_id_number',
        'birthplace',
        'birthdate',
        'gender',
        'sibling_name',
        'sibling_class',
        'school_choice',
        'registration_type',
        'admission_wave_id',
        'selected_class',
        'track',
        'selection_method',
        'previous_school_type',
        'previous_school_name',
        'registration_info_source',
        'registration_reason',
        'registration_step',
        'registration_status',
        'created_by',
        'updated_by',
        'student_id',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    /**
     * The attributes that should be set to default values.
     */
    protected $attributes = [
        'registration_step' => 'waiting_registration_fee',
        'registration_status' => 'pending',
    ];

    /**
     * Get the possible values for registration_step.
     */
    public static function getRegistrationSteps(): array
    {
        return [
            'waiting_registration_fee',
            'registration_fee_confirmed',
            'observation',
            'parent_interview',
            'announcement',
            'waiting_final_payment_fee',
            'final_payment_confirmed_fee',
            'documents',
            'finished',
        ];
    }

    /**
     * Get the possible values for registration_status.
     */
    public static function getRegistrationStatuses(): array
    {
        return [
            'pending',
            'passed',
            'failed',
        ];
    }

    /**
     * Get the label for a registration step.
     */
    public static function getRegistrationStepLabel(string $step): string
    {
        $labels = [
            'waiting_registration_fee' => 'Waiting Registration Fee',
            'registration_fee_confirmed' => 'Registration Fee Confirmed',
            'observation' => 'Observation',
            'parent_interview' => 'Parent Interview',
            'announcement' => 'Announcement',
            'waiting_final_payment_fee' => 'Waiting Final Payment Fee',
            'final_payment_confirmed_fee' => 'Final Payment Confirmed',
            'documents' => 'Documents',
            'finished' => 'Finished',
        ];

        return $labels[$step] ?? $step;
    }

    /**
     * Get the label for a registration status.
     */
    public static function getRegistrationStatusLabel(string $status): string
    {
        $labels = [
            'pending' => 'Pending',
            'passed' => 'Passed',
            'failed' => 'Failed',
        ];

        return $labels[$status] ?? $status;
    }

    /**
     * Get the current step index for validation.
     */
    public function getCurrentStepIndex(): int
    {
        $steps = self::getRegistrationSteps();
        return array_search($this->registration_step, $steps);
    }

    /**
     * Get the next valid step for this registration.
     */
    public function getNextValidStep(): ?string
    {
        $steps = self::getRegistrationSteps();
        $currentIndex = $this->getCurrentStepIndex();
        
        if ($currentIndex === false || $currentIndex >= count($steps) - 1) {
            return null;
        }
        
        return $steps[$currentIndex + 1];
    }

    /**
     * Check if a step transition is valid (forward-only, sequential).
     */
    public function isValidStepTransition(string $newStep): bool
    {
        $steps = self::getRegistrationSteps();
        $currentIndex = $this->getCurrentStepIndex();
        $newIndex = array_search($newStep, $steps);

        // Invalid step
        if ($newIndex === false) {
            return false;
        }

        // Can't go backward
        if ($newIndex <= $currentIndex) {
            return false;
        }

        // Can only move one step forward
        if ($newIndex !== $currentIndex + 1) {
            return false;
        }

        return true;
    }

    /**
     * Check if registration status can be updated.
     */
    public function canUpdateRegistrationStatus(): bool
    {
        $steps = self::getRegistrationSteps();
        $currentIndex = $this->getCurrentStepIndex();
        $finalPaymentIndex = array_search('final_payment_confirmed_fee', $steps);

        return $currentIndex >= $finalPaymentIndex;
    }

    /**
     * Get validation error message for invalid step transition.
     */
    public function getStepTransitionError(string $newStep): string
    {
        $steps = self::getRegistrationSteps();
        $currentIndex = $this->getCurrentStepIndex();
        $newIndex = array_search($newStep, $steps);

        if ($newIndex === false) {
            return "Invalid registration step: {$newStep}";
        }

        if ($newIndex <= $currentIndex) {
            return "Cannot move backward from " . self::getRegistrationStepLabel($this->registration_step) . " to " . self::getRegistrationStepLabel($newStep);
        }

        if ($newIndex > $currentIndex + 1) {
            $nextStep = $this->getNextValidStep();
            return "Cannot skip steps. Next valid step is: " . ($nextStep ? self::getRegistrationStepLabel($nextStep) : 'None');
        }

        return "Invalid step transition";
    }

    /**
     * Get all valid steps that can be selected (only next step).
     */
    public function getValidNextSteps(): array
    {
        $nextStep = $this->getNextValidStep();
        return $nextStep ? [$nextStep] : [];
    }

    /**
     * Get the guardians for the student registration.
     */
    public function guardians(): HasMany
    {
        return $this->hasMany(Guardian::class);
    }

    /**
     * Get the payments for the student registration.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the admission wave for the student registration.
     */
    public function admissionWave(): BelongsTo
    {
        return $this->belongsTo(AdmissionWave::class);
    }

    /**
     * Get the student record if this registration has been copied.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Check if this registration has been copied to students table.
     */
    public function hasBeenCopiedToStudents(): bool
    {
        return !is_null($this->student_id);
    }

    /**
     * Check if this registration can be copied to students table.
     */
    public function canBeCopiedToStudents(): bool
    {
        return $this->registration_status === 'passed' && !$this->hasBeenCopiedToStudents();
    }

    /**
     * Boot method to handle model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($studentRegistration) {
            $studentRegistration->createPayments();
        });
    }

    /**
     * Create automatic payments when student registration is created.
     */
    public function createPayments(): void
    {
        if (!$this->admissionWave) {
            return;
        }

        $admissionWave = $this->admissionWave;

        // Create registration fee payment
        Payment::create([
            'student_registration_id' => $this->id,
            'admission_wave_id' => $admissionWave->id,
            'level' => $admissionWave->level,
            'amount' => $admissionWave->registration_fee,
            'type' => 'registration_fee',
            'status' => 'unpaid',
        ]);

        // Create final payment fee payment
        Payment::create([
            'student_registration_id' => $this->id,
            'admission_wave_id' => $admissionWave->id,
            'level' => $admissionWave->level,
            'amount' => $admissionWave->final_payment_fee,
            'type' => 'final_payment_fee',
            'status' => 'unpaid',
        ]);
    }
}
