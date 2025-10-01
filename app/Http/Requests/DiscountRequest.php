<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'amount' => 'required|integer|min:1',
            'type' => 'required|in:internal,early_bird,other',
            'level' => 'nullable|in:kb,tk,sd',
            'admission_wave_id' => 'nullable|exists:admission_waves,id',
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
            'name.required' => 'The discount name is required.',
            'name.max' => 'The discount name may not be greater than 255 characters.',
            'amount.required' => 'The discount amount is required.',
            'amount.integer' => 'The discount amount must be a number.',
            'amount.min' => 'The discount amount must be greater than 0.',
            'type.required' => 'The discount type is required.',
            'type.in' => 'The selected discount type is invalid.',
            'level.in' => 'The selected level is invalid.',
            'admission_wave_id.exists' => 'The selected admission wave does not exist.',
        ];
    }
}
