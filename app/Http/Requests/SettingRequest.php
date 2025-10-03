<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|max:160',
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
            'site_name.required' => 'The site name is required.',
            'site_name.max' => 'The site name may not be greater than 255 characters.',
            'contact_email.required' => 'The contact email is required.',
            'contact_email.email' => 'The contact email must be a valid email address.',
            'contact_email.max' => 'The contact email may not be greater than 255 characters.',
            'contact_phone.max' => 'The contact phone may not be greater than 20 characters.',
            'facebook_url.url' => 'The Facebook URL must be a valid URL.',
            'twitter_url.url' => 'The Twitter URL must be a valid URL.',
            'instagram_url.url' => 'The Instagram URL must be a valid URL.',
            'youtube_url.url' => 'The YouTube URL must be a valid URL.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif.',
            'logo.max' => 'The logo may not be greater than 2MB.',
            'favicon.image' => 'The favicon must be an image.',
            'favicon.mimes' => 'The favicon must be a file of type: ico, png.',
            'favicon.max' => 'The favicon may not be greater than 1MB.',
            'meta_description.max' => 'The meta description may not be greater than 160 characters.',
        ];
    }
}