<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
        $rules = [
            'type' => 'required|in:image,video,pdf',
        ];

        // For store method, file is required
        if ($this->isMethod('post')) {
            $rules['file'] = 'required|file|mimes:jpeg,png,jpg,gif,pdf,mp4,avi,mov|max:10240';
        } else {
            // For update method, file is optional
            $rules['file'] = 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,mp4,avi,mov|max:10240';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'file.required' => 'A file is required.',
            'file.file' => 'The uploaded file must be a valid file.',
            'file.mimes' => 'The file must be a file of type: jpeg, png, jpg, gif, pdf, mp4, avi, mov.',
            'file.max' => 'The file may not be greater than 10MB.',
            'type.required' => 'The media type is required.',
            'type.in' => 'The selected media type is invalid.',
        ];
    }
}