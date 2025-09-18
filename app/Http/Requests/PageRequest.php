<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'content' => 'required|string',
            'type' => 'required|in:about,vision_mission,career,faq',
            'status' => 'required|in:draft,published',
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
            'title.required' => 'The page title is required.',
            'title.max' => 'The page title may not be greater than 255 characters.',
            'content.required' => 'The page content is required.',
            'type.required' => 'The page type is required.',
            'type.in' => 'The selected page type is invalid.',
            'status.required' => 'The page status is required.',
            'status.in' => 'The selected page status is invalid.',
        ];
    }
}