<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\AdmissionWave;
use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudentRegistration::with(['admissionWave']);

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

        // Order by created_at descending (default)
        $studentRegistrations = $query->latest()->paginate(10);

        // Get admission waves for filter dropdown
        $admissionWaves = AdmissionWave::select('id', 'name', 'level')
            ->orderBy('name')
            ->get();

        return view('cms.student-registrations.index', compact('studentRegistrations', 'admissionWaves'));
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentRegistration $studentRegistration)
    {
        $studentRegistration->load(['admissionWave', 'guardians']);
        
        return view('cms.student-registrations.show', compact('studentRegistration'));
    }
}