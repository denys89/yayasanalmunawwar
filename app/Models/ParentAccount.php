<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParentAccount extends Model
{
    protected $fillable = [
        'student_registration_id',
        'user_id',
        'email',
        'username',
        'password',
    ];

    /**
     * The student registration this parent account is linked to.
     */
    public function studentRegistration(): BelongsTo
    {
        return $this->belongsTo(StudentRegistration::class);
    }

    /**
     * The underlying user record for authentication.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}