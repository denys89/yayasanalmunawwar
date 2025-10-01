<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\StudentRegistration;

class UpdateStudentRegistrationRequest extends FormRequest
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
        $studentRegistration = $this->route('student_registration');
        
        return [
            'registration_step' => [
                'sometimes',
                'string',
                'in:' . implode(',', StudentRegistration::getRegistrationSteps()),
                function ($attribute, $value, $fail) use ($studentRegistration) {
                    if ($value && !$studentRegistration->isValidStepTransition($value)) {
                        $fail($studentRegistration->getStepTransitionError($value));
                    }
                },
            ],
            'registration_status' => [
                'sometimes',
                'string',
                'in:' . implode(',', StudentRegistration::getRegistrationStatuses()),
                function ($attribute, $value, $fail) use ($studentRegistration) {
                    if ($value && !$studentRegistration->canUpdateRegistrationStatus()) {
                        $fail('Registration status can only be updated after final payment is confirmed.');
                    }
                },
            ],
            'updated_by' => 'sometimes|integer|exists:users,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'registration_step.in' => 'The selected registration step is invalid.',
            'registration_status.in' => 'The selected registration status is invalid.',
            'updated_by.exists' => 'The specified user does not exist.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'registration_step' => 'registration step',
            'registration_status' => 'registration status',
            'updated_by' => 'updated by user',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Automatically set updated_by to current authenticated user
        if (auth()->check()) {
            $this->merge([
                'updated_by' => auth()->id(),
            ]);
        }
    }
}