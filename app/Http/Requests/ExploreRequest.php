<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExploreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category' => 'required|in:facility,extracurricular',
            'content' => 'required|string',
            'image_url' => 'nullable|url',
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
            'title.required' => 'The explore title is required.',
            'title.max' => 'The explore title may not be greater than 255 characters.',
            'category.required' => 'The explore category is required.',
            'category.in' => 'The selected explore category is invalid.',
            'content.required' => 'The explore content is required.',
            'image_url.url' => 'The image URL must be a valid URL.',
        ];
    }
}