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
        'subject',
        'phone_number',
        'destination',
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
            'subject' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'destination' => 'required|in:kb/tk,sd,panti,masjid',
            'message' => 'required|string|max:5000',
        ];
    }
}