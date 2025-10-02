<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;
use App\Models\ParentAccount;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Get payment overview for parent
     */
    public function index(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);
        
        $paymentOverview = [
            'summary' => $this->getPaymentSummary($students),
            'recent_payments' => $this->getRecentPayments($students),
            'upcoming_payments' => $this->getUpcomingPayments($students),
            'payment_history' => $this->getPaymentHistoryData($students, 5)
        ];

        return response()->json($paymentOverview);
    }

    /**
     * Get detailed payment history with filters
     */
    public function getPaymentHistory(Request $request)
    {
        $parent = $request->user();

        // Resolve student registrations linked to this parent
        $studentRegistrationIds = ParentAccount::query()
            ->where('user_id', $parent->id)
            ->pluck('student_registration_id');

        $page = (int) $request->get('page', 1);
        $perPage = (int) $request->get('per_page', 10);

        $query = Payment::query()
            ->with(['studentRegistration', 'admissionWave'])
            ->whereIn('student_registration_id', $studentRegistrationIds)
            ->orderByDesc('created_at');

        // Optional filters
        if ($request->filled('student_id')) {
            $query->where('student_registration_id', (int) $request->get('student_id'));
        }

        if ($request->filled('payment_type')) {
            $type = $request->get('payment_type');
            // Map frontend type to backend type if needed
            $typeMap = [
                'registration' => ['registration_fee', 'final_payment_fee'],
            ];
            if (isset($typeMap[$type])) {
                $query->whereIn('type', $typeMap[$type]);
            } else {
                $query->where('type', $type);
            }
        }

        if ($request->filled('status')) {
            $status = $request->get('status');
            // Backend has: unpaid, pending, paid. Map 'overdue' to unpaid/pending later when computing.
            if (in_array($status, ['unpaid', 'pending', 'paid'])) {
                $query->where('status', $status);
            }
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        $items = collect($paginator->items())->map(function (Payment $payment) {
            $student = $payment->studentRegistration;
            $dueDate = $payment->created_at ? Carbon::parse($payment->created_at)->toDateString() : Carbon::now()->toDateString();
            $paidAt = $payment->status === 'paid' && $payment->updated_at
                ? Carbon::parse($payment->updated_at)->toDateString()
                : null;

            // Map backend status to frontend expected statuses
            $status = $payment->status;
            if (in_array($status, ['unpaid', 'pending'])) {
                $isOverdue = Carbon::parse($dueDate)->isPast() && $status !== 'paid';
                $status = $isOverdue ? 'overdue' : 'pending';
            }

            $typeLabelMap = [
                'registration_fee' => 'Registration Fee',
                'final_payment_fee' => 'Final Payment Fee',
            ];

            // Determine upload ability based on registration step and payment type
            $regStep = $student?->registration_step;
            $canUploadProof = false;
            if ($payment->type === 'registration_fee') {
                $canUploadProof = ($regStep === 'waiting_registration_fee') && !$payment->proof_url;
            } elseif ($payment->type === 'final_payment_fee') {
                $canUploadProof = ($regStep === 'waiting_final_payment_fee') && !$payment->proof_url;
            }

            return [
                'id' => $payment->id,
                'student_id' => $payment->student_registration_id,
                'student_name' => $student?->full_name,
                'type' => $payment->type === 'registration_fee' || $payment->type === 'final_payment_fee' ? 'registration' : ($payment->type ?? 'other'),
                'original_type' => $payment->type,
                'description' => $typeLabelMap[$payment->type] ?? ucfirst(str_replace('_', ' ', (string) $payment->type)),
                'amount' => (float) $payment->amount,
                'due_date' => $dueDate,
                'paid_at' => $paidAt,
                'status' => $status,
                'payment_method' => null,
                'reference_number' => 'INV-' . str_pad((string) $payment->id, 6, '0', STR_PAD_LEFT),
                'notes' => null,
                'created_at' => $payment->created_at ? $payment->created_at->toDateTimeString() : null,
                'updated_at' => $payment->updated_at ? $payment->updated_at->toDateTimeString() : null,
                'proof_url' => $payment->proof_url ? Storage::url($payment->proof_url) : null,
                'proof_uploaded' => (bool) $payment->proof_url,
                'can_upload_proof' => $canUploadProof,
            ];
        })->all();

        return response()->json([
            'success' => true,
            'message' => 'Payment history fetched',
            'data' => $items,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ]);
    }

    /**
     * Get specific payment details
     */
    public function show(Request $request, $paymentId)
    {
        $parent = $request->user();
        $payment = $this->getPaymentDetails($paymentId, $parent->id);
        
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found or access denied'
            ], 404);
        }

        return response()->json([
            'payment' => $payment,
            'bank_transfer' => $this->getBankTransferInfo(),
        ]);
    }

    /**
     * Download payment invoice
     */
    public function downloadInvoice(Request $request, $paymentId)
    {
        $parent = $request->user();
        $payment = $this->getPaymentDetails($paymentId, $parent->id);
        
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found or access denied'
            ], 404);
        }

        $data = [
            'payment' => $payment,
            'parent' => $parent,
            'school_info' => $this->getSchoolInfo(),
            'generated_date' => now()->format('Y-m-d H:i:s')
        ];

        $pdf = Pdf::loadView('parent-portal.invoice', $data);
        
        return $pdf->download('invoice_' . $payment['invoice_number'] . '.pdf');
    }

    /**
     * Get payment statistics for charts
     */
    public function getPaymentStats(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);
        $year = $request->get('year', date('Y'));
        
        $stats = [
            'monthly_payments' => $this->getMonthlyPaymentStats($students, $year),
            'payment_by_type' => $this->getPaymentByType($students, $year),
            'payment_trends' => $this->getPaymentTrends($students),
            'comparison' => $this->getYearlyComparison($students)
        ];

        return response()->json($stats);
    }

    /**
     * Process online payment (placeholder for payment gateway integration)
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|integer',
            'payment_method' => 'required|string|in:credit_card,bank_transfer,e_wallet',
            'amount' => 'required|numeric|min:0'
        ]);

        $parent = $request->user();
        $paymentId = $request->payment_id;
        
        // Verify payment belongs to parent
        $payment = $this->getPaymentDetails($paymentId, $parent->id);
        
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found or access denied'
            ], 404);
        }

        // In a real application, integrate with payment gateway here
        // For now, we'll simulate a successful payment
        
        $transactionId = 'TXN' . time() . rand(1000, 9999);
        
        // Update payment status (in real app, this would be in database)
        $result = $this->updatePaymentStatus($paymentId, 'paid', $transactionId);
        
        return response()->json([
            'success' => true,
            'message' => 'Payment processed successfully',
            'transaction_id' => $transactionId,
            'payment_status' => 'paid'
        ]);
    }

    /**
     * Get payment reminders
     */
    public function getReminders(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);
        
        $reminders = $this->getPaymentReminders($students);
        
        return response()->json([
            'reminders' => $reminders
        ]);
    }

    /**
     * Helper: Get parent's students
     */
    private function getParentStudents($parentId)
    {
        return [
            [
                'id' => 1,
                'name' => 'Ahmad Rizki',
                'student_id' => 'STD001',
                'class' => 'Grade 5A'
            ],
            [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'student_id' => 'STD002',
                'class' => 'Grade 3B'
            ]
        ];
    }

    /**
     * Helper: Get payment summary
     */
    private function getPaymentSummary($students)
    {
        return [
            'total_outstanding' => 2250000, // IDR
            'overdue_amount' => 0,
            'paid_this_month' => 1500000,
            'next_payment_due' => '2024-02-15',
            'payment_status' => 'current',
            'total_students' => count($students)
        ];
    }

    /**
     * Helper: Get recent payments
     */
    private function getRecentPayments($students)
    {
        return [
            [
                'id' => 1,
                'student_name' => 'Ahmad Rizki',
                'amount' => 750000,
                'description' => 'Monthly Tuition Fee - January 2024',
                'payment_date' => '2024-01-15',
                'status' => 'paid',
                'payment_method' => 'bank_transfer',
                'invoice_number' => 'INV-2024-001'
            ],
            [
                'id' => 2,
                'student_name' => 'Siti Nurhaliza',
                'amount' => 750000,
                'description' => 'Monthly Tuition Fee - January 2024',
                'payment_date' => '2024-01-15',
                'status' => 'paid',
                'payment_method' => 'credit_card',
                'invoice_number' => 'INV-2024-002'
            ]
        ];
    }

    /**
     * Helper: Get upcoming payments
     */
    private function getUpcomingPayments($students)
    {
        return [
            [
                'id' => 3,
                'student_name' => 'Ahmad Rizki',
                'amount' => 750000,
                'description' => 'Monthly Tuition Fee - February 2024',
                'due_date' => '2024-02-15',
                'status' => 'pending',
                'payment_type' => 'tuition',
                'can_pay_online' => true
            ],
            [
                'id' => 4,
                'student_name' => 'Siti Nurhaliza',
                'amount' => 750000,
                'description' => 'Monthly Tuition Fee - February 2024',
                'due_date' => '2024-02-15',
                'status' => 'pending',
                'payment_type' => 'tuition',
                'can_pay_online' => true
            ]
        ];
    }

    /**
     * Helper: Get payment history data
     */
    private function getPaymentHistoryData($students, $limit = null)
    {
        $payments = [
            ['id' => 1, 'student_name' => 'Ahmad Rizki', 'amount' => 750000, 'description' => 'Tuition - Jan 2024', 'date' => '2024-01-15', 'status' => 'paid'],
            ['id' => 2, 'student_name' => 'Siti Nurhaliza', 'amount' => 750000, 'description' => 'Tuition - Jan 2024', 'date' => '2024-01-15', 'status' => 'paid'],
            ['id' => 3, 'student_name' => 'Ahmad Rizki', 'amount' => 750000, 'description' => 'Tuition - Dec 2023', 'date' => '2023-12-15', 'status' => 'paid'],
            ['id' => 4, 'student_name' => 'Siti Nurhaliza', 'amount' => 750000, 'description' => 'Tuition - Dec 2023', 'date' => '2023-12-15', 'status' => 'paid'],
            ['id' => 5, 'student_name' => 'Ahmad Rizki', 'amount' => 200000, 'description' => 'Activity Fee', 'date' => '2023-11-20', 'status' => 'paid']
        ];
        
        return $limit ? array_slice($payments, 0, $limit) : $payments;
    }

    /**
     * Helper: Get filtered payments with pagination
     */
    private function getFilteredPayments($students, $filters, $page, $perPage)
    {
        $allPayments = $this->getPaymentHistoryData($students);
        
        // Apply filters (simplified for demo)
        $filteredPayments = $allPayments;
        
        $total = count($filteredPayments);
        $offset = ($page - 1) * $perPage;
        $paginatedPayments = array_slice($filteredPayments, $offset, $perPage);
        
        return [
            'data' => $paginatedPayments,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => ceil($total / $perPage)
            ]
        ];
    }

    /**
     * Helper: Get payment details
     */
    private function getPaymentDetails($paymentId, $parentId)
    {
        $studentRegistrationIds = ParentAccount::query()
            ->where('user_id', $parentId)
            ->pluck('student_registration_id')
            ->all();

        $payment = Payment::query()
            ->with(['studentRegistration', 'admissionWave'])
            ->find($paymentId);

        if (!$payment || !in_array($payment->student_registration_id, $studentRegistrationIds)) {
            return null;
        }

        $student = $payment->studentRegistration;
        $dueDate = $payment->created_at ? Carbon::parse($payment->created_at)->toDateString() : Carbon::now()->toDateString();
        $paidAt = $payment->status === 'paid' && $payment->updated_at
            ? Carbon::parse($payment->updated_at)->toDateString()
            : null;

        $status = $payment->status;
        if (in_array($status, ['unpaid', 'pending'])) {
            $isOverdue = Carbon::parse($dueDate)->isPast() && $status !== 'paid';
            $status = $isOverdue ? 'overdue' : 'pending';
        }

        $typeLabelMap = [
            'registration_fee' => 'Registration Fee',
            'final_payment_fee' => 'Final Payment Fee',
        ];

        // Determine upload ability based on registration step and payment type
        $regStep = $student?->registration_step;
        $canUploadProof = false;
        if ($payment->type === 'registration_fee') {
            $canUploadProof = ($regStep === 'waiting_registration_fee') && !$payment->proof_url;
        } elseif ($payment->type === 'final_payment_fee') {
            $canUploadProof = ($regStep === 'waiting_final_payment_fee') && !$payment->proof_url;
        }

        return [
            'id' => $payment->id,
            'student_id' => $payment->student_registration_id,
            'student_name' => $student?->full_name,
            'type' => $payment->type === 'registration_fee' || $payment->type === 'final_payment_fee' ? 'registration' : ($payment->type ?? 'other'),
            'original_type' => $payment->type,
            'description' => $typeLabelMap[$payment->type] ?? ucfirst(str_replace('_', ' ', (string) $payment->type)),
            'amount' => (float) $payment->amount,
            'due_date' => $dueDate,
            'paid_at' => $paidAt,
            'status' => $status,
            'payment_method' => null,
            'reference_number' => 'INV-' . str_pad((string) $payment->id, 6, '0', STR_PAD_LEFT),
            'notes' => null,
            'created_at' => $payment->created_at ? $payment->created_at->toDateTimeString() : null,
            'updated_at' => $payment->updated_at ? $payment->updated_at->toDateTimeString() : null,
            'proof_url' => $payment->proof_url ? Storage::url($payment->proof_url) : null,
            'proof_uploaded' => (bool) $payment->proof_url,
            'can_upload_proof' => $canUploadProof,
        ];
    }

    /**
     * Upload transfer proof (image) for a payment by parent.
     */
    public function uploadTransferProof(Request $request, $paymentId)
    {
        $request->validate([
            'proof_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $parent = $request->user();

        // Verify payment belongs to this parent
        $details = $this->getPaymentDetails($paymentId, $parent->id);
        if (!$details) {
            return response()->json(['message' => 'Payment not found or access denied'], 404);
        }

        // Enforce one upload per payment
        if (!empty($details['proof_uploaded'])) {
            return response()->json(['message' => 'Transfer proof already uploaded for this payment'], 422);
        }

        // Restrict by registration step and payment type
        $payment = Payment::find($paymentId);
        $registration = $payment?->studentRegistration;
        if (!$payment || !$registration) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($payment->type === 'registration_fee') {
            if ($registration->registration_step !== 'waiting_registration_fee') {
                return response()->json(['message' => 'Upload not allowed in current registration step'], 422);
            }
        } elseif ($payment->type === 'final_payment_fee') {
            if ($registration->registration_step !== 'waiting_final_payment_fee') {
                return response()->json(['message' => 'Upload not allowed in current registration step'], 422);
            }
        } else {
            return response()->json(['message' => 'Upload available only for registration-related payments'], 422);
        }

        // Store image proof
        $path = $request->file('proof_url')->store('transfer-proofs', 'public');

        // Update payment with proof and set status to pending if unpaid
        $payment->proof_url = $path;
        if ($payment->status === 'unpaid') {
            $payment->status = 'pending';
        }
        // Clear confirmed_by when not paid
        if ($payment->status !== 'paid') {
            $payment->confirmed_by = null;
        }
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Transfer proof uploaded successfully',
            'data' => [
                'proof_url' => Storage::url($payment->proof_url),
                'payment_status' => $payment->status,
            ]
        ]);
    }

    /**
     * View transfer proof image for a payment by parent.
     */
    public function viewTransferProof(Request $request, $paymentId)
    {
        $parent = $request->user();
        $details = $this->getPaymentDetails($paymentId, $parent->id);
        if (!$details) {
            return response()->json(['message' => 'Payment not found or access denied'], 404);
        }

        $payment = Payment::find($paymentId);
        if (!$payment || !$payment->proof_url || !Storage::disk('public')->exists($payment->proof_url)) {
            return response()->json(['message' => 'Transfer proof not found'], 404);
        }

        return response()->file(Storage::disk('public')->path($payment->proof_url));
    }

    /**
     * Helper: Get monthly payment statistics
     */
    private function getMonthlyPaymentStats($students, $year)
    {
        return [
            ['month' => 'Jan', 'amount' => 1500000, 'count' => 2],
            ['month' => 'Feb', 'amount' => 1500000, 'count' => 2],
            ['month' => 'Mar', 'amount' => 1500000, 'count' => 2],
            ['month' => 'Apr', 'amount' => 1500000, 'count' => 2],
            ['month' => 'May', 'amount' => 1500000, 'count' => 2],
            ['month' => 'Jun', 'amount' => 1500000, 'count' => 2]
        ];
    }

    /**
     * Helper: Get payment by type
     */
    private function getPaymentByType($students, $year)
    {
        return [
            ['type' => 'Tuition', 'amount' => 9000000, 'percentage' => 85],
            ['type' => 'Activity Fee', 'amount' => 1000000, 'percentage' => 10],
            ['type' => 'Other Fees', 'amount' => 500000, 'percentage' => 5]
        ];
    }

    /**
     * Helper: Get payment trends
     */
    private function getPaymentTrends($students)
    {
        return [
            ['period' => '2023 Q1', 'amount' => 4500000],
            ['period' => '2023 Q2', 'amount' => 4500000],
            ['period' => '2023 Q3', 'amount' => 4500000],
            ['period' => '2023 Q4', 'amount' => 4500000],
            ['period' => '2024 Q1', 'amount' => 4500000]
        ];
    }

    /**
     * Helper: Get yearly comparison
     */
    private function getYearlyComparison($students)
    {
        return [
            'current_year' => 18000000,
            'previous_year' => 17000000,
            'growth_percentage' => 5.9
        ];
    }

    /**
     * Helper: Get payment history summary
     */
    private function getPaymentHistorySummary($students, $filters)
    {
        return [
            'total_payments' => 25,
            'total_amount' => 18750000,
            'average_payment' => 750000,
            'on_time_payments' => 23,
            'late_payments' => 2
        ];
    }

    /**
     * Helper: Update payment status
     */
    private function updatePaymentStatus($paymentId, $status, $transactionId)
    {
        $payment = Payment::find($paymentId);
        if (!$payment) {
            return false;
        }

        $allowedStatuses = ['unpaid', 'pending', 'paid'];
        if (!in_array($status, $allowedStatuses)) {
            return false;
        }

        // Update payment status
        $payment->status = $status;
        // Optionally store transaction reference in notes if desired
        // $payment->notes = $transactionId; // requires column
        return $payment->save();
    }

    /**
     * Helper: Get payment reminders
     */
    private function getPaymentReminders($students)
    {
        return [
            [
                'student_name' => 'Ahmad Rizki',
                'amount' => 750000,
                'due_date' => '2024-02-15',
                'days_until_due' => 10,
                'description' => 'Monthly Tuition Fee - February 2024',
                'priority' => 'medium'
            ]
        ];
    }

    /**
     * Helper: Get school information
     */
    private function getSchoolInfo()
    {
        return [
            'name' => 'Yayasan Al Munawwar',
            'address' => 'School Address Here',
            'phone' => '+62-21-12345678',
            'email' => 'info@school.com',
            'logo' => '/images/school-logo.png'
        ];
    }

    /**
     * Helper: Bank transfer information for payment instructions
     */
    private function getBankTransferInfo()
    {
        return [
            'bank_name' => 'Bank Central Asia (BCA)',
            'account_number' => '123-456-7890',
            'account_holder' => 'Yayasan Al Munawwar',
            'instructions' => 'Please include the student name and invoice number in the transfer notes. Upload the transfer proof once payment is made.'
        ];
    }
}