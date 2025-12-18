<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AdmissionWave;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of students.
     */
    public function index(Request $request)
    {
        $query = Student::with(['admissionWave', 'guardians']);

        // Search by student name
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Filter by selected class
        if ($request->filled('selected_class')) {
            $query->where('selected_class', $request->selected_class);
        }

        // Filter by admission wave
        if ($request->filled('admission_wave_id')) {
            $query->where('admission_wave_id', $request->admission_wave_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Order by enrolled_at descending (default)
        $students = $query->latest('enrolled_at')->paginate(10);

        // Get admission waves for filter dropdown
        $admissionWaves = AdmissionWave::select('id', 'name', 'level')
            ->orderBy('name')
            ->get();

        return view('cms.students.index', compact('students', 'admissionWaves'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        // Get admission waves for dropdown
        $admissionWaves = AdmissionWave::select('id', 'name', 'level')
            ->orderBy('name')
            ->get();
        
        return view('cms.students.create', compact('admissionWaves'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Personal Information
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
            
            // Academic Information
            'admission_wave_id' => 'nullable|exists:admission_waves,id',
            'selected_class' => 'required|in:kb,tk,sd',
            'registration_type' => 'required|string|max:255',
            
            // Previous School
            'previous_school_type' => 'required|string|max:255',
            'previous_school_name' => 'required|string|max:255',
            
            // Status
            'status' => 'required|in:active,inactive,graduated',
            'enrolled_at' => 'nullable|date',
            
            // Guardian Information
            'guardians' => 'required|array|min:1',
            'guardians.*.type' => 'required|in:father,mother,guardian,brother,sister,grandfather,grandmother,uncle,aunty,other',
            'guardians.*.name' => 'required|string|max:255',
            'guardians.*.job' => 'nullable|string|max:255',
            'guardians.*.company' => 'nullable|string|max:255',
            'guardians.*.email' => 'nullable|email|max:255',
            'guardians.*.phone' => 'nullable|string|max:255',
            'guardians.*.address' => 'nullable|string',
        ]);

        try {
            \DB::beginTransaction();

            // Create student
            $student = Student::create([
                'student_registration_id' => null, // Manual creation, no registration
                'admission_wave_id' => $validated['admission_wave_id'] ?? null,
                'full_name' => $validated['full_name'],
                'nickname' => $validated['nickname'] ?? null,
                'family_card_number' => $validated['family_card_number'],
                'national_id_number' => $validated['national_id_number'],
                'birthplace' => $validated['birthplace'],
                'birthdate' => $validated['birthdate'],
                'gender' => $validated['gender'],
                'sibling_name' => $validated['sibling_name'] ?? null,
                'sibling_class' => $validated['sibling_class'] ?? null,
                'selected_class' => $validated['selected_class'],
                'registration_type' => $validated['registration_type'],
                'previous_school_type' => $validated['previous_school_type'],
                'previous_school_name' => $validated['previous_school_name'],
                'status' => $validated['status'],
                'enrolled_at' => $validated['enrolled_at'] ?? now(),
                'created_by' => Auth::id(),
            ]);

            // Create guardians
            foreach ($validated['guardians'] as $guardianData) {
                $student->guardians()->create($guardianData);
            }

            \DB::commit();

            return redirect()
                ->route('cms.students.show', $student)
                ->with('success', 'Student created successfully.');

        } catch (\Exception $e) {
            \DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create student: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load(['admissionWave', 'guardians', 'studentRegistration']);
        
        return view('cms.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $student->load(['guardians']);
        
        return view('cms.students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'sibling_name' => 'nullable|string|max:255',
            'sibling_class' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,graduated',
        ]);

        $this->studentService->updateStudent($student, $validated);

        return redirect()
            ->route('cms.students.show', $student)
            ->with('success', 'Student information updated successfully.');
    }

    /**
     * Remove the specified student from storage (soft delete or status change).
     */
    public function destroy(Student $student)
    {
        // Instead of deleting, we change status to inactive
        $this->studentService->updateStudent($student, ['status' => 'inactive']);

        return redirect()
            ->route('cms.students.index')
            ->with('success', 'Student status changed to inactive.');
    }
}
