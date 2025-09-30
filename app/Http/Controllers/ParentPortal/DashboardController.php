<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get dashboard overview data
     */
    public function index(Request $request)
    {
        $parent = $request->user();
        
        // Get parent's students
        $students = $this->getParentStudents($parent->id);
        
        // Calculate overview statistics
        $overviewData = [
            'total_students' => $students->count(),
            'attendance_overview' => $this->getAttendanceOverview($students),
            'payment_summary' => $this->getPaymentSummary($students),
            'recent_grades' => $this->getRecentGrades($students),
            'announcements' => $this->getRecentAnnouncements(),
        ];

        return response()->json([
            'overview' => $overviewData,
            'students' => $students
        ]);
    }

    /**
     * Get attendance overview for dashboard cards
     */
    public function getAttendanceStats(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);
        
        $attendanceData = [];
        
        foreach ($students as $student) {
            $attendanceData[] = [
                'student_id' => $student->id,
                'student_name' => $student->name,
                'attendance_percentage' => $this->calculateAttendancePercentage($student->id),
                'monthly_data' => $this->getMonthlyAttendance($student->id)
            ];
        }

        return response()->json([
            'attendance_data' => $attendanceData
        ]);
    }

    /**
     * Get payment overview for dashboard
     */
    public function getPaymentOverview(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);
        
        $paymentData = [
            'total_due' => 0,
            'overdue_count' => 0,
            'next_payment' => null,
            'payment_history' => []
        ];
        
        foreach ($students as $student) {
            $payments = $this->getStudentPayments($student->id);
            $paymentData['total_due'] += $payments['total_due'];
            $paymentData['overdue_count'] += $payments['overdue_count'];
            
            if (!$paymentData['next_payment'] || 
                ($payments['next_payment'] && $payments['next_payment']['due_date'] < $paymentData['next_payment']['due_date'])) {
                $paymentData['next_payment'] = $payments['next_payment'];
            }
        }

        return response()->json($paymentData);
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
                                'id', 'title', 'content', 'category', 
                                'created_at', 'image_url'
                            ]);

        return response()->json([
            'announcements' => $announcements
        ]);
    }

    /**
     * Helper: Get parent's students
     */
    private function getParentStudents($parentId)
    {
        // This would typically join with a students table
        // For now, we'll simulate with a basic structure
        return collect([
            (object) [
                'id' => 1,
                'name' => 'Student Name',
                'class' => 'Grade 5A',
                'teacher' => 'Mrs. Smith',
                'photo' => null,
                'parent_id' => $parentId
            ]
        ]);
    }

    /**
     * Helper: Get attendance overview
     */
    private function getAttendanceOverview($students)
    {
        $totalDays = 30; // Current month days
        $presentDays = 28; // Mock data
        
        return [
            'percentage' => round(($presentDays / $totalDays) * 100, 1),
            'present_days' => $presentDays,
            'total_days' => $totalDays,
            'absent_days' => $totalDays - $presentDays
        ];
    }

    /**
     * Helper: Get payment summary
     */
    private function getPaymentSummary($students)
    {
        return [
            'total_due' => 1500000, // IDR
            'overdue_amount' => 0,
            'next_due_date' => '2024-02-15',
            'status' => 'current'
        ];
    }

    /**
     * Helper: Get recent grades
     */
    private function getRecentGrades($students)
    {
        return [
            [
                'subject' => 'Mathematics',
                'grade' => 'A',
                'score' => 95,
                'date' => '2024-01-20'
            ],
            [
                'subject' => 'English',
                'grade' => 'B+',
                'score' => 88,
                'date' => '2024-01-18'
            ]
        ];
    }

    /**
     * Helper: Get recent announcements
     */
    private function getRecentAnnouncements()
    {
        return News::where('status', 'published')
                  ->orderBy('created_at', 'desc')
                  ->limit(3)
                  ->get(['id', 'title', 'content', 'created_at', 'category']);
    }

    /**
     * Helper: Calculate attendance percentage
     */
    private function calculateAttendancePercentage($studentId)
    {
        // Mock calculation - in real app, this would query attendance records
        return rand(85, 98);
    }

    /**
     * Helper: Get monthly attendance data
     */
    private function getMonthlyAttendance($studentId)
    {
        // Mock data for charts
        return [
            ['month' => 'Jan', 'percentage' => 95],
            ['month' => 'Feb', 'percentage' => 92],
            ['month' => 'Mar', 'percentage' => 98],
            ['month' => 'Apr', 'percentage' => 90],
            ['month' => 'May', 'percentage' => 94],
            ['month' => 'Jun', 'percentage' => 96]
        ];
    }

    /**
     * Helper: Get student payments
     */
    private function getStudentPayments($studentId)
    {
        return [
            'total_due' => 750000,
            'overdue_count' => 0,
            'next_payment' => [
                'amount' => 750000,
                'due_date' => '2024-02-15',
                'description' => 'Monthly Tuition Fee'
            ]
        ];
    }
}