<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
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
            'question.required' => 'The FAQ question is required.',
            'question.max' => 'The FAQ question may not be greater than 500 characters.',
            'answer.required' => 'The FAQ answer is required.',
            'category.max' => 'The FAQ category may not be greater than 100 characters.',
            'order.integer' => 'The order must be an integer.',
            'order.min' => 'The order must be at least 0.',
            'is_active.boolean' => 'The active status must be true or false.',
        ];
    }
}