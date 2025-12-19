<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\MonthlyPayment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonthlyPaymentController extends Controller
{
    /**
     * Display a listing of monthly payments.
     */
    public function index(Request $request)
    {
        $query = MonthlyPayment::with(['student', 'confirmedBy']);

        // Filter by payment period
        if ($request->filled('payment_period')) {
            $query->forPeriod($request->payment_period);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->withStatus($request->status);
        }

        // Filter by student
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        // Search by student name
        if ($request->filled('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Order by period descending, then by student name
        $payments = $query->orderBy('payment_year', 'desc')
            ->orderBy('payment_month', 'desc')
            ->paginate(20);

        // Get unique periods for filter dropdown
        $periods = MonthlyPayment::select('payment_period', 'payment_year', 'payment_month')
            ->groupBy('payment_period', 'payment_year', 'payment_month')
            ->orderBy('payment_year', 'desc')
            ->orderBy('payment_month', 'desc')
            ->get()
            ->map(function ($p) {
                return [
                    'value' => $p->payment_period,
                    'label' => $p->period_name
                ];
            });

        return view('cms.monthly-payments.index', compact('payments', 'periods'));
    }

    /**
     * Show the form for creating a new payment for a specific student.
     */
    public function create(Request $request)
    {
        // Get all active students
        $students = Student::where('status', 'active')
            ->orderBy('full_name')
            ->get();

        $currentYear = date('Y');
        $currentMonth = date('n');

        return view('cms.monthly-payments.create', compact('students', 'currentYear', 'currentMonth'));
    }

    /**
     * Store a newly created payment for a specific student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_month' => 'required|integer|min:1|max:12',
            'payment_year' => 'required|integer|min:2020|max:2100',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        $paymentPeriod = sprintf('%04d-%02d', $validated['payment_year'], $validated['payment_month']);

        // Check if payment already exists for this student and period
        $existingPayment = MonthlyPayment::where('student_id', $validated['student_id'])
            ->forPeriod($paymentPeriod)
            ->first();
        
        if ($existingPayment) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Payment for this student already exists for {$paymentPeriod}.");
        }

        try {
            $payment = MonthlyPayment::create([
                'student_id' => $validated['student_id'],
                'payment_period' => $paymentPeriod,
                'payment_month' => $validated['payment_month'],
                'payment_year' => $validated['payment_year'],
                'amount' => $validated['amount'],
                'status' => 'unpaid',
                'due_date' => $validated['due_date'],
            ]);

            $student = Student::find($validated['student_id']);

            return redirect()
                ->route('cms.monthly-payments.show', $payment)
                ->with('success', "Successfully created payment for {$student->full_name} ({$paymentPeriod}).");

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create payment: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified payment.
     */
    public function show(MonthlyPayment $monthlyPayment)
    {
        $monthlyPayment->load(['student.guardians', 'confirmedBy']);
        
        return view('cms.monthly-payments.show', compact('monthlyPayment'));
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(MonthlyPayment $monthlyPayment)
    {
        return view('cms.monthly-payments.edit', compact('monthlyPayment'));
    }

    /**
     * Update the specified payment.
     */
    public function update(Request $request, MonthlyPayment $monthlyPayment)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:unpaid,pending,paid,overdue',
            'notes' => 'nullable|string',
        ]);

        // If marking as paid, add confirmation details
        if ($validated['status'] === 'paid' && $monthlyPayment->status !== 'paid') {
            $validated['paid_at'] = now();
            $validated['confirmed_by'] = Auth::id();
            $validated['confirmed_at'] = now();
        }

        $monthlyPayment->update($validated);

        return redirect()
            ->route('cms.monthly-payments.show', $monthlyPayment)
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Confirm payment as paid.
     */
    public function confirm(Request $request, MonthlyPayment $monthlyPayment)
    {
        if ($monthlyPayment->isPaid()) {
            return redirect()
                ->back()
                ->with('error', 'This payment is already confirmed as paid.');
        }

        $validated = $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $monthlyPayment->markAsPaid(Auth::user(), $validated['notes'] ?? null);

        return redirect()
            ->route('cms.monthly-payments.show', $monthlyPayment)
            ->with('success', 'Payment confirmed as paid successfully.');
    }

    /**
     * Remove the specified payment.
     */
    public function destroy(MonthlyPayment $monthlyPayment)
    {
        if ($monthlyPayment->isPaid()) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete a paid payment.');
        }

        $monthlyPayment->delete();

        return redirect()
            ->route('cms.monthly-payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
