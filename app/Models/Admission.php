<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'level',
        'document_url',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope for pending admissions
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for verified admissions
     */
    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    /**
     * Scope for rejected admissions
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
