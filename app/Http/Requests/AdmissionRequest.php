<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'level' => 'required|in:paud,sd,smp,sma',
            'document_url' => 'nullable|url',
            'status' => 'required|in:pending,verified,rejected',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The applicant name is required.',
            'name.max' => 'The applicant name may not be greater than 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'email.max' => 'The email address may not be greater than 255 characters.',
            'phone.required' => 'The phone number is required.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
            'level.required' => 'The education level is required.',
            'level.in' => 'The selected education level is invalid.',
            'document_url.url' => 'The document URL must be a valid URL.',
            'status.required' => 'The admission status is required.',
            'status.in' => 'The selected admission status is invalid.',
        ];
    }
}