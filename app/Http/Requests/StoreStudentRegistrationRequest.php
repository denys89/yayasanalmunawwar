<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Student Personal Information
            'full_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'family_card_number' => 'required|string|max:255',
            'national_id_number' => 'required|string|max:255',
            'birthplace' => 'required|string|max:255',
            'birthdate' => 'required|date|before:today',
            'gender' => 'required|in:male,female',

            // Sibling Information
            'sibling_name' => 'nullable|string|max:255',
            'sibling_class' => 'nullable|string|max:255',

            // Registration Information
            'school_choice' => 'required|string|max:255',
            'registration_type' => 'required|string|max:255',
            'admission_wave_id' => 'required|exists:admission_waves,id',
            'selected_class' => 'required|in:kb,tk,sd',
            'track' => 'required|string|max:255',
            'selection_method' => 'required|string|max:255',

            // Previous School Information
            'previous_school_type' => 'required|string|max:255',
            'previous_school_name' => 'required|string|max:255',

            // Additional Information
            'registration_info_source' => 'required|string|max:255',
            'registration_reason' => 'nullable|string',

            // Guardian Information - Father
            'father.name' => 'nullable|string|max:255',
            'father.job' => 'nullable|string|max:255',
            'father.company' => 'nullable|string|max:255',
            'father.email' => 'nullable|email|max:255',
            'father.phone' => 'nullable|string|max:255',
            'father.address' => 'nullable|string',

            // Guardian Information - Mother
            'mother.name' => 'nullable|string|max:255',
            'mother.job' => 'nullable|string|max:255',
            'mother.company' => 'nullable|string|max:255',
            'mother.email' => 'nullable|email|max:255',
            'mother.phone' => 'nullable|string|max:255',
            'mother.address' => 'nullable|string',

            // Guardian Information - Guardian
            'guardian.name' => 'nullable|string|max:255',
            'guardian.job' => 'nullable|string|max:255',
            'guardian.company' => 'nullable|string|max:255',
            'guardian.email' => 'nullable|email|max:255',
            'guardian.phone' => 'nullable|string|max:255',
            'guardian.address' => 'nullable|string',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Ensure at least one guardian is provided
            $hasFather = !empty($this->input('father.name'));
            $hasMother = !empty($this->input('mother.name'));
            $hasGuardian = !empty($this->input('guardian.name'));

            if (!$hasFather && !$hasMother && !$hasGuardian) {
                $validator->errors()->add(
                    'guardians',
                    'At least one guardian (Father, Mother, or Guardian) must be provided.'
                );
            }
        });
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'full_name' => 'full name',
            'family_card_number' => 'family card number',
            'national_id_number' => 'national ID number',
            'birthdate' => 'date of birth',
            'admission_wave_id' => 'admission wave',
            'selected_class' => 'class',
            'previous_school_type' => 'previous school type',
            'previous_school_name' => 'previous school name',
            'registration_info_source' => 'information source',
            'father.name' => 'father\'s name',
            'father.email' => 'father\'s email',
            'father.phone' => 'father\'s phone',
            'mother.name' => 'mother\'s name',
            'mother.email' => 'mother\'s email',
            'mother.phone' => 'mother\'s phone',
            'guardian.name' => 'guardian\'s name',
            'guardian.email' => 'guardian\'s email',
            'guardian.phone' => 'guardian\'s phone',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'birthdate.before' => 'The date of birth must be a date before today.',
            'admission_wave_id.exists' => 'The selected admission wave is invalid.',
        ];
    }
}
