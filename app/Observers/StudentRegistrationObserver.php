<?php

namespace App\Observers;

use App\Models\StudentRegistration;
use App\Services\StudentService;

class StudentRegistrationObserver
{
    /**
     * Handle the StudentRegistration "updated" event.
     * We check the dirty attributes directly in the updated event.
     */
    public function updated(StudentRegistration $studentRegistration): void
    {
        // Check if registration_status was changed to 'passed' and student hasn't been copied yet
        if ($studentRegistration->wasChanged('registration_status') && 
            $studentRegistration->registration_status === 'passed' &&
            $studentRegistration->canBeCopiedToStudents()) {
            
            $studentService = app(StudentService::class);
            
            try {
                $studentService->copyFromRegistration($studentRegistration);
                
                // Log success
                \Log::info('Successfully copied student registration to students table', [
                    'registration_id' => $studentRegistration->id,
                    'student_id' => $studentRegistration->fresh()->student_id,
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to copy student registration to students table', [
                    'registration_id' => $studentRegistration->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }
    }

    /**
     * Handle the StudentRegistration "created" event.
     */
    public function created(StudentRegistration $studentRegistration): void
    {
        //
    }

    /**
     * Handle the StudentRegistration "deleted" event.
     */
    public function deleted(StudentRegistration $studentRegistration): void
    {
        //
    }

    /**
     * Handle the StudentRegistration "restored" event.
     */
    public function restored(StudentRegistration $studentRegistration): void
    {
        //
    }

    /**
     * Handle the StudentRegistration "force deleted" event.
     */
    public function forceDeleted(StudentRegistration $studentRegistration): void
    {
        //
    }
}
