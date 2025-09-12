<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'payment_history' => $this->getPaymentHistory($students, 5)
        ];

        return response()->json($paymentOverview);
    }

    /**
     * Get detailed payment history with filters
     */
    public function getPaymentHistory(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);
        
        $filters = [
            'student_id' => $request->get('student_id'),
            'status' => $request->get('status'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'payment_type' => $request->get('payment_type')
        ];
        
        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 10);
        
        $payments = $this->getFilteredPayments($students, $filters, $page, $perPage);
        
        return response()->json([
            'payments' => $payments['data'],
            'pagination' => $payments['pagination'],
            'summary' => $this->getPaymentHistorySummary($students, $filters)
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
            'payment' => $payment
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
     * Helper: Get payment history
     */
    private function getPaymentHistory($students, $limit = null)
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
        $allPayments = $this->getPaymentHistory($students);
        
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
        // Mock payment details
        $payments = [
            1 => [
                'id' => 1,
                'student_name' => 'Ahmad Rizki',
                'student_id' => 'STD001',
                'amount' => 750000,
                'description' => 'Monthly Tuition Fee - January 2024',
                'payment_date' => '2024-01-15',
                'due_date' => '2024-01-15',
                'status' => 'paid',
                'payment_method' => 'bank_transfer',
                'invoice_number' => 'INV-2024-001',
                'transaction_id' => 'TXN123456789',
                'breakdown' => [
                    ['item' => 'Tuition Fee', 'amount' => 650000],
                    ['item' => 'Activity Fee', 'amount' => 50000],
                    ['item' => 'Library Fee', 'amount' => 50000]
                ]
            ]
        ];
        
        return $payments[$paymentId] ?? null;
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
        // In real app, this would update the database
        return true;
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
}