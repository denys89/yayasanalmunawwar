<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\AdmissionWave;
use App\Models\Payment;
use App\Models\Guardian;
use App\Http\Requests\UpdateStudentRegistrationRequest;
use App\Http\Requests\StoreStudentRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

        // Filter by registration step
        if ($request->filled('registration_step')) {
            $query->where('registration_step', $request->registration_step);
        }

        // Filter by registration status
        if ($request->filled('registration_status')) {
            $query->where('registration_status', $request->registration_status);
        }

        // Order by created_at descending (default)
        $studentRegistrations = $query->latest()->paginate(10);

        // Get admission waves for filter dropdown
        $admissionWaves = AdmissionWave::select('id', 'name', 'level')
            ->orderBy('name')
            ->get();

        // Get registration steps and statuses for filters with labels
        $registrationSteps = [
            'waiting_registration_fee' => 'Waiting Registration Fee',
            'registration_fee_confirmed' => 'Registration Fee Confirmed',
            'observation' => 'Observation',
            'parent_interview' => 'Parent Interview',
            'announcement' => 'Announcement',
            'waiting_final_payment_fee' => 'Waiting Final Payment Fee',
            'final_payment_confirmed_fee' => 'Final Payment Confirmed',
            'documents' => 'Documents',
            'finished' => 'Finished',
        ];
        
        $registrationStatuses = [
            'pending' => 'Pending',
            'passed' => 'Passed',
            'failed' => 'Failed',
        ];

        return view('cms.student-registrations.index', compact(
            'studentRegistrations', 
            'admissionWaves', 
            'registrationSteps', 
            'registrationStatuses'
        ));
    }

    /**
     * Show the form for creating a new student registration.
     */
    public function create()
    {
        // Get active admission waves for dropdown
        $admissionWaves = AdmissionWave::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('cms.student-registrations.create', compact('admissionWaves'));
    }

    /**
     * Store a newly created student registration.
     */
    public function store(StoreStudentRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create student registration
            $studentRegistration = StudentRegistration::create([
                'full_name' => $request->full_name,
                'nickname' => $request->nickname,
                'family_card_number' => $request->family_card_number,
                'national_id_number' => $request->national_id_number,
                'birthplace' => $request->birthplace,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'sibling_name' => $request->sibling_name,
                'sibling_class' => $request->sibling_class,
                'school_choice' => $request->school_choice,
                'registration_type' => $request->registration_type,
                'admission_wave_id' => $request->admission_wave_id,
                'selected_class' => $request->selected_class,
                'track' => $request->track,
                'selection_method' => $request->selection_method,
                'previous_school_type' => $request->previous_school_type,
                'previous_school_name' => $request->previous_school_name,
                'registration_info_source' => $request->registration_info_source,
                'registration_reason' => $request->registration_reason,
                'created_by' => Auth::id(),
            ]);

            // Create guardians
            $this->createGuardian($studentRegistration, 'father', $request->input('father'));
            $this->createGuardian($studentRegistration, 'mother', $request->input('mother'));
            $this->createGuardian($studentRegistration, 'guardian', $request->input('guardian'));

            DB::commit();

            return redirect()
                ->route('cms.student-registrations.show', $studentRegistration)
                ->with('success', 'Student registration created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create student registration. Please try again.');
        }
    }

    /**
     * Helper method to create a guardian if data is provided.
     */
    private function createGuardian(StudentRegistration $studentRegistration, string $type, ?array $data): void
    {
        // Only create guardian if name is provided
        if (empty($data['name'])) {
            return;
        }

        Guardian::create([
            'student_registration_id' => $studentRegistration->id,
            'type' => $type,
            'name' => $data['name'],
            'job' => $data['job'] ?? null,
            'company' => $data['company'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(StudentRegistration $studentRegistration)
    {
        $studentRegistration->load(['admissionWave', 'guardians', 'payments']);
        
        // Get registration steps and statuses for dropdowns with labels
        $registrationSteps = [
            'waiting_registration_fee' => 'Waiting Registration Fee',
            'registration_fee_confirmed' => 'Registration Fee Confirmed',
            'observation' => 'Observation',
            'parent_interview' => 'Parent Interview',
            'announcement' => 'Announcement',
            'waiting_final_payment_fee' => 'Waiting Final Payment Fee',
            'final_payment_confirmed_fee' => 'Final Payment Confirmed',
            'documents' => 'Documents',
            'finished' => 'Finished',
        ];
        
        $registrationStatuses = [
            'pending' => 'Pending',
            'passed' => 'Passed',
            'failed' => 'Failed',
        ];
        
        return view('cms.student-registrations.show', compact(
            'studentRegistration', 
            'registrationSteps', 
            'registrationStatuses'
        ));
    }

    /**
     * Update the registration step and status.
     */
    public function update(UpdateStudentRegistrationRequest $request, StudentRegistration $studentRegistration)
    {
        $validated = $request->validated();
        
        // Only update fields that are present in the request
        $updateData = [];
        
        if (isset($validated['registration_step'])) {
            $updateData['registration_step'] = $validated['registration_step'];
        }
        
        if (isset($validated['registration_status'])) {
            $updateData['registration_status'] = $validated['registration_status'];
        }
        
        if (isset($validated['updated_by'])) {
            $updateData['updated_by'] = $validated['updated_by'];
        }

        $studentRegistration->update($updateData);

        return redirect()
            ->route('cms.student-registrations.show', $studentRegistration)
            ->with('success', 'Registration updated successfully.');
    }

    /**
     * Update payment status.
     */
    public function updatePaymentStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:unpaid,pending,paid',
        ]);

        // Validation: Once paid, cannot be reverted to unpaid
        if ($payment->status === 'paid' && $request->status === 'unpaid') {
            return redirect()->back()->with('error', 'Cannot revert a paid payment to unpaid.');
        }

        $updateData = ['status' => $request->status];

        // If status is being set to paid, set confirmed_by to current admin
        if ($request->status === 'paid') {
            $updateData['confirmed_by'] = Auth::id();
        }

        // If status is not paid, clear confirmed_by
        if ($request->status !== 'paid') {
            $updateData['confirmed_by'] = null;
        }

        $payment->update($updateData);

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    /**
     * Upload transfer proof for payment.
     */
    public function uploadTransferProof(Request $request, Payment $payment)
    {
        $request->validate([
            'proof_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete old transfer proof if exists
        if ($payment->proof_url) {
            Storage::disk('public')->delete($payment->proof_url);
        }

        // Store new transfer proof
        $path = $request->file('proof_url')->store('transfer-proofs', 'public');

        $payment->update([
            'proof_url' => $path,
        ]);

        return redirect()->back()->with('success', 'Transfer proof uploaded successfully.');
    }

    /**
     * View transfer proof for payment.
     */
    public function viewTransferProof(Payment $payment)
    {
        if (!$payment->proof_url || !Storage::disk('public')->exists($payment->proof_url)) {
            abort(404, 'Transfer proof not found.');
        }

        return response()->file(Storage::disk('public')->path($payment->proof_url));
    }
}