<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\AdmissionWave;
use App\Models\Payment;
use App\Http\Requests\UpdateStudentRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'foto_bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete old transfer proof if exists
        if ($payment->foto_bukti_transfer) {
            Storage::disk('public')->delete($payment->foto_bukti_transfer);
        }

        // Store new transfer proof
        $path = $request->file('foto_bukti_transfer')->store('transfer-proofs', 'public');

        $payment->update([
            'foto_bukti_transfer' => $path,
        ]);

        return redirect()->back()->with('success', 'Transfer proof uploaded successfully.');
    }

    /**
     * View transfer proof for payment.
     */
    public function viewTransferProof(Payment $payment)
    {
        if (!$payment->foto_bukti_transfer || !Storage::disk('public')->exists($payment->foto_bukti_transfer)) {
            abort(404, 'Transfer proof not found.');
        }

        return response()->file(Storage::disk('public')->path($payment->foto_bukti_transfer));
    }
}