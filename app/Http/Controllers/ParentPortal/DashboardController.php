<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\ParentAccount;
use App\Models\Payment;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get dashboard overview data with real registration and payments
     */
    public function index(Request $request)
    {
        $parent = $request->user();

        $parentAccount = ParentAccount::where('user_id', $parent->id)->first();

        $registration = null;
        $students = collect();
        $paymentSummary = null;

        if ($parentAccount) {
            $registration = StudentRegistration::with(['payments', 'guardians', 'admissionWave'])
                ->find($parentAccount->student_registration_id);

            if ($registration) {
                // Map registration to student structure expected by frontend
                $students = collect([
                    (object) [
                        'id' => $registration->id,
                        'name' => $registration->full_name,
                        'student_id' => null,
                        'class' => $registration->selected_class,
                        'grade_level' => $registration->selected_class,
                        'photo' => null,
                    ]
                ]);

                $paymentSummary = $this->buildPaymentSummary($registration);
            }
        }

        $overviewData = [
            'total_students' => $students->count(),
            // Minimal attendance card for now
            'attendance_overview' => [
                'percentage' => 0,
                'present_days' => 0,
                'total_days' => 0,
                'absent_days' => 0,
            ],
            'registration' => $registration ? [
                'step' => $registration->registration_step,
                'step_label' => StudentRegistration::getRegistrationStepLabel($registration->registration_step),
                'status' => $registration->registration_status,
                'status_label' => StudentRegistration::getRegistrationStatusLabel($registration->registration_status),
            ] : null,
            'payment_summary' => $paymentSummary,
            'announcements' => $this->getRecentAnnouncements(),
        ];

        return response()->json([
            'data' => [
                'overview' => $overviewData,
                'students' => $students,
            ]
        ]);
    }

    /**
     * Get payment overview for dashboard based on real payments
     */
    public function getPaymentOverview(Request $request)
    {
        $parent = $request->user();
        $parentAccount = ParentAccount::where('user_id', $parent->id)->first();

        $paymentData = [
            'total_due' => 0,
            'overdue_count' => 0,
            'next_payment' => null,
            'payment_history' => [],
        ];

        if ($parentAccount) {
            $registration = StudentRegistration::with('payments')->find($parentAccount->student_registration_id);
            if ($registration) {
                $summary = $this->buildPaymentSummary($registration);
                $paymentData['total_due'] = $summary['total_due'];
                $paymentData['overdue_count'] = $summary['overdue_count'];
                $paymentData['next_payment'] = $summary['next_payment'];
                // Simple history: last 5 payments
                $paymentData['payment_history'] = $registration->payments
                    ->sortByDesc('created_at')
                    ->take(5)
                    ->map(function (Payment $p) {
                        return [
                            'id' => $p->id,
                            'amount' => $p->amount,
                            'status' => $p->status,
                            'type' => $p->type,
                            'created_at' => $p->created_at,
                        ];
                    })->values();
            }
        }

        return response()->json([
            'data' => $paymentData
        ]);
    }

    /**
     * Get attendance statistics (stub until attendance data is available)
     */
    public function getAttendanceStats(Request $request)
    {
        $overview = [
            'percentage' => 0,
            'present_days' => 0,
            'total_days' => 0,
            'absent_days' => 0,
        ];

        return response()->json([
            'data' => [
                'attendance_overview' => $overview
            ]
        ]);
    }

    /**
     * Get recent announcements
     */
    public function getAnnouncements(Request $request)
    {
        $announcements = News::where('status', 'published')
            ->where('category', 'news')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get([
                'id', 'title', 'content', 'category', 'created_at', 'image_url'
            ]);

        return response()->json([
            'data' => [
                'announcements' => $announcements
            ]
        ]);
    }

    /**
     * Helper: Build payment summary from registration payments
     */
    private function buildPaymentSummary(StudentRegistration $registration): array
    {
        $payments = $registration->payments()->get();

        $unpaidStatuses = ['unpaid', 'pending'];
        $totalDue = $payments->whereIn('status', $unpaidStatuses)
            ->sum(function (Payment $p) {
                return (float) $p->amount;
            });

        // Determine next payment: prioritize unpaid registration_fee then final_payment_fee
        $next = $payments->whereIn('status', $unpaidStatuses)
            ->sortBy(function (Payment $p) {
                return $p->type === 'registration_fee' ? 0 : 1;
            })
            ->first();

        $nextPayment = $next ? [
            'amount' => (float) $next->amount,
            'due_date' => null, // Not available in schema
            'description' => $next->type === 'registration_fee' ? 'Registration Fee' : 'Final Payment Fee',
            'status' => $next->status,
            'type' => $next->type,
        ] : null;

        return [
            'total_due' => (float) $totalDue,
            'overdue_count' => 0, // due date field not present
            'next_payment' => $nextPayment,
            'status' => $totalDue > 0 ? 'due' : 'paid',
        ];
    }

    /**
     * Helper: Get recent announcements for overview
     */
    private function getRecentAnnouncements()
    {
        return News::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get(['id', 'title', 'content', 'created_at', 'category']);
    }
}