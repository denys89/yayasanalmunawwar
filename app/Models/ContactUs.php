<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message',
    ];

    /**
     * Basic validation rules useful for manual validation.
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
            'message' => 'required|string',
        ];
    }
}