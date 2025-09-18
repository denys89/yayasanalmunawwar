<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'category' => 'required|in:news,event,coverage',
            'image_url' => 'nullable|url',
            'published_at' => 'nullable|date',
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
            'title.required' => 'The news title is required.',
            'title.max' => 'The news title may not be greater than 255 characters.',
            'content.required' => 'The news content is required.',
            'category.required' => 'The news category is required.',
            'category.in' => 'The selected news category is invalid.',
            'image_url.url' => 'The image URL must be a valid URL.',
            'published_at.date' => 'The published date must be a valid date.',
            'status.required' => 'The news status is required.',
            'status.in' => 'The selected news status is invalid.',
        ];
    }
}