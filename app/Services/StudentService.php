<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudentRegistration;
use App\Models\StudentGuardian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentService
{
    /**
     * Copy student registration data to students table.
     */
    public function copyFromRegistration(StudentRegistration $registration): Student
    {
        return DB::transaction(function () use ($registration) {
            // Create student record
            $student = Student::create([
                'student_registration_id' => $registration->id,
                'admission_wave_id' => $registration->admission_wave_id,
                'full_name' => $registration->full_name,
                'nickname' => $registration->nickname,
                'family_card_number' => $registration->family_card_number,
                'national_id_number' => $registration->national_id_number,
                'birthplace' => $registration->birthplace,
                'birthdate' => $registration->birthdate,
                'gender' => $registration->gender,
                'sibling_name' => $registration->sibling_name,
                'sibling_class' => $registration->sibling_class,
                'selected_class' => $registration->selected_class,
                'registration_type' => $registration->registration_type,
                'previous_school_type' => $registration->previous_school_type,
                'previous_school_name' => $registration->previous_school_name,
                'status' => 'active',
                'enrolled_at' => now(),
                'created_by' => Auth::id(),
            ]);

            // Copy guardian records
            foreach ($registration->guardians as $guardian) {
                StudentGuardian::create([
                    'student_id' => $student->id,
                    'type' => $guardian->type,
                    'name' => $guardian->name,
                    'job' => $guardian->job,
                    'company' => $guardian->company,
                    'email' => $guardian->email,
                    'phone' => $guardian->phone,
                    'address' => $guardian->address,
                ]);
            }

            // Update registration with student_id
            $registration->update([
                'student_id' => $student->id,
            ]);

            return $student;
        });
    }

    /**
     * Update student information.
     */
    public function updateStudent(Student $student, array $data): Student
    {
        $student->update(array_merge($data, [
            'updated_by' => Auth::id(),
        ]));

        return $student->fresh();
    }

    /**
     * Get students by class.
     */
    public function getStudentsByClass(string $class)
    {
        return Student::byClass($class)
            ->with(['admissionWave', 'guardians'])
            ->latest()
            ->get();
    }

    /**
     * Get students by admission wave.
     */
    public function getStudentsByAdmissionWave(int $waveId)
    {
        return Student::byAdmissionWave($waveId)
            ->with(['admissionWave', 'guardians'])
            ->latest()
            ->get();
    }
}
