<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentRegistration extends Model
{
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
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    /**
     * Get the guardians for the student registration.
     */
    public function guardians(): HasMany
    {
        return $this->hasMany(Guardian::class);
    }

    /**
     * Get the admission wave for the student registration.
     */
    public function admissionWave(): BelongsTo
    {
        return $this->belongsTo(AdmissionWave::class);
    }
}
