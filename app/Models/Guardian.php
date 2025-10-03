<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guardian extends Model
{
    protected $fillable = [
        'student_registration_id',
        'type',
        'name',
        'job',
        'company',
        'email',
        'phone',
        'address',
    ];

    /**
     * Get the student registration that owns the guardian.
     */
    public function studentRegistration(): BelongsTo
    {
        return $this->belongsTo(StudentRegistration::class);
    }
}
