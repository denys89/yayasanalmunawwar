<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    /**
     * Get all students for the authenticated parent
     */
    public function index(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);

        return response()->json([
            'students' => $students
        ]);
    }

    /**
     * Get specific student details
     */
    public function show(Request $request, $studentId)
    {
        $parent = $request->user();
        $student = $this->getStudentDetails($studentId, $parent->id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found or access denied'
            ], 404);
        }

        return response()->json([
            'student' => $student
        ]);
    }

    /**
     * Get student attendance history
     */
    public function getAttendance(Request $request, $studentId)
    {
        $parent = $request->user();
        
        // Verify parent has access to this student
        if (!$this->verifyStudentAccess($studentId, $parent->id)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $month = $request->get('month', date('Y-m'));
        $year = $request->get('year', date('Y'));

        $attendanceData = [
            'monthly_summary' => $this->getMonthlyAttendanceSummary($studentId, $month),
            'daily_records' => $this->getDailyAttendanceRecords($studentId, $month),
            'yearly_overview' => $this->getYearlyAttendanceOverview($studentId, $year),
            'attendance_chart_data' => $this->getAttendanceChartData($studentId, $year)
        ];

        return response()->json($attendanceData);
    }

    /**
     * Get student grades and academic performance
     */
    public function getGrades(Request $request, $studentId)
    {
        $parent = $request->user();
        
        if (!$this->verifyStudentAccess($studentId, $parent->id)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $semester = $request->get('semester', 'current');
        $academicYear = $request->get('academic_year', '2023-2024');

        $gradesData = [
            'current_grades' => $this->getCurrentGrades($studentId),
            'grade_history' => $this->getGradeHistory($studentId, $academicYear),
            'subject_performance' => $this->getSubjectPerformance($studentId),
            'grade_trends' => $this->getGradeTrends($studentId)
        ];

        return response()->json($gradesData);
    }

    /**
     * Download student report card
     */
    public function downloadReportCard(Request $request, $studentId)
    {
        $parent = $request->user();
        
        if (!$this->verifyStudentAccess($studentId, $parent->id)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $student = $this->getStudentDetails($studentId, $parent->id);
        $grades = $this->getCurrentGrades($studentId);
        $attendance = $this->getMonthlyAttendanceSummary($studentId, date('Y-m'));

        $data = [
            'student' => $student,
            'grades' => $grades,
            'attendance' => $attendance,
            'generated_date' => now()->format('Y-m-d')
        ];

        $pdf = Pdf::loadView('parent-portal.report-card', $data);
        
        return $pdf->download($student['name'] . '_report_card.pdf');
    }

    /**
     * Get student schedule/timetable
     */
    public function getSchedule(Request $request, $studentId)
    {
        $parent = $request->user();
        
        if (!$this->verifyStudentAccess($studentId, $parent->id)) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $schedule = $this->getStudentSchedule($studentId);

        return response()->json([
            'schedule' => $schedule
        ]);
    }

    /**
     * Helper: Get parent's students
     */
    private function getParentStudents($parentId)
    {
        // Mock data - in real app, this would query students table
        return [
            [
                'id' => 1,
                'name' => 'Ahmad Rizki',
                'student_id' => 'STD001',
                'class' => 'Grade 5A',
                'teacher' => 'Mrs. Sarah Johnson',
                'photo' => '/images/students/student1.jpg',
                'date_of_birth' => '2014-03-15',
                'enrollment_date' => '2020-07-01',
                'status' => 'active'
            ],
            [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'student_id' => 'STD002',
                'class' => 'Grade 3B',
                'teacher' => 'Mr. David Wilson',
                'photo' => '/images/students/student2.jpg',
                'date_of_birth' => '2016-08-22',
                'enrollment_date' => '2022-07-01',
                'status' => 'active'
            ]
        ];
    }

    /**
     * Helper: Get detailed student information
     */
    private function getStudentDetails($studentId, $parentId)
    {
        $students = $this->getParentStudents($parentId);
        
        foreach ($students as $student) {
            if ($student['id'] == $studentId) {
                return array_merge($student, [
                    'emergency_contact' => [
                        'name' => 'Parent Name',
                        'phone' => '+62812345678',
                        'relationship' => 'Parent'
                    ],
                    'medical_info' => [
                        'allergies' => 'None',
                        'medications' => 'None',
                        'blood_type' => 'O+'
                    ],
                    'academic_info' => [
                        'gpa' => 3.8,
                        'rank' => 5,
                        'total_students' => 30
                    ]
                ]);
            }
        }
        
        return null;
    }

    /**
     * Helper: Verify parent has access to student
     */
    private function verifyStudentAccess($studentId, $parentId)
    {
        $students = $this->getParentStudents($parentId);
        
        foreach ($students as $student) {
            if ($student['id'] == $studentId) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Helper: Get monthly attendance summary
     */
    private function getMonthlyAttendanceSummary($studentId, $month)
    {
        return [
            'total_days' => 22,
            'present_days' => 20,
            'absent_days' => 2,
            'late_days' => 1,
            'percentage' => 90.9,
            'month' => $month
        ];
    }

    /**
     * Helper: Get daily attendance records
     */
    private function getDailyAttendanceRecords($studentId, $month)
    {
        // Mock daily attendance data
        $records = [];
        $daysInMonth = date('t', strtotime($month . '-01'));
        
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
            $dayOfWeek = date('N', strtotime($date));
            
            if ($dayOfWeek <= 5) { // Weekdays only
                $records[] = [
                    'date' => $date,
                    'status' => rand(1, 10) > 1 ? 'present' : 'absent',
                    'time_in' => '07:30:00',
                    'time_out' => '14:00:00',
                    'notes' => ''
                ];
            }
        }
        
        return $records;
    }

    /**
     * Helper: Get yearly attendance overview
     */
    private function getYearlyAttendanceOverview($studentId, $year)
    {
        return [
            'total_school_days' => 200,
            'total_present' => 185,
            'total_absent' => 15,
            'yearly_percentage' => 92.5
        ];
    }

    /**
     * Helper: Get attendance chart data
     */
    private function getAttendanceChartData($studentId, $year)
    {
        return [
            ['month' => 'Jan', 'percentage' => 95],
            ['month' => 'Feb', 'percentage' => 92],
            ['month' => 'Mar', 'percentage' => 98],
            ['month' => 'Apr', 'percentage' => 90],
            ['month' => 'May', 'percentage' => 94],
            ['month' => 'Jun', 'percentage' => 96],
            ['month' => 'Jul', 'percentage' => 88],
            ['month' => 'Aug', 'percentage' => 93],
            ['month' => 'Sep', 'percentage' => 97],
            ['month' => 'Oct', 'percentage' => 91],
            ['month' => 'Nov', 'percentage' => 89],
            ['month' => 'Dec', 'percentage' => 95]
        ];
    }

    /**
     * Helper: Get current grades
     */
    private function getCurrentGrades($studentId)
    {
        return [
            ['subject' => 'Mathematics', 'grade' => 'A', 'score' => 95, 'teacher' => 'Mrs. Smith'],
            ['subject' => 'English', 'grade' => 'B+', 'score' => 88, 'teacher' => 'Mr. Johnson'],
            ['subject' => 'Science', 'grade' => 'A-', 'score' => 92, 'teacher' => 'Dr. Brown'],
            ['subject' => 'Social Studies', 'grade' => 'B', 'score' => 85, 'teacher' => 'Ms. Davis'],
            ['subject' => 'Physical Education', 'grade' => 'A', 'score' => 96, 'teacher' => 'Coach Wilson']
        ];
    }

    /**
     * Helper: Get grade history
     */
    private function getGradeHistory($studentId, $academicYear)
    {
        return [
            'semester_1' => [
                ['subject' => 'Mathematics', 'grade' => 'B+', 'score' => 88],
                ['subject' => 'English', 'grade' => 'B', 'score' => 85],
                ['subject' => 'Science', 'grade' => 'A-', 'score' => 90]
            ],
            'semester_2' => [
                ['subject' => 'Mathematics', 'grade' => 'A', 'score' => 95],
                ['subject' => 'English', 'grade' => 'B+', 'score' => 88],
                ['subject' => 'Science', 'grade' => 'A-', 'score' => 92]
            ]
        ];
    }

    /**
     * Helper: Get subject performance
     */
    private function getSubjectPerformance($studentId)
    {
        return [
            'strongest_subjects' => ['Mathematics', 'Physical Education'],
            'improvement_needed' => ['Social Studies'],
            'average_score' => 91.2,
            'class_rank' => 5
        ];
    }

    /**
     * Helper: Get grade trends
     */
    private function getGradeTrends($studentId)
    {
        return [
            ['month' => 'Sep', 'average' => 85],
            ['month' => 'Oct', 'average' => 87],
            ['month' => 'Nov', 'average' => 89],
            ['month' => 'Dec', 'average' => 91],
            ['month' => 'Jan', 'average' => 92]
        ];
    }

    /**
     * Helper: Get student schedule
     */
    private function getStudentSchedule($studentId)
    {
        return [
            'monday' => [
                ['time' => '08:00-09:00', 'subject' => 'Mathematics', 'teacher' => 'Mrs. Smith', 'room' => 'A101'],
                ['time' => '09:00-10:00', 'subject' => 'English', 'teacher' => 'Mr. Johnson', 'room' => 'B205'],
                ['time' => '10:30-11:30', 'subject' => 'Science', 'teacher' => 'Dr. Brown', 'room' => 'C301']
            ],
            'tuesday' => [
                ['time' => '08:00-09:00', 'subject' => 'Social Studies', 'teacher' => 'Ms. Davis', 'room' => 'A102'],
                ['time' => '09:00-10:00', 'subject' => 'Mathematics', 'teacher' => 'Mrs. Smith', 'room' => 'A101'],
                ['time' => '10:30-11:30', 'subject' => 'Art', 'teacher' => 'Mr. Wilson', 'room' => 'D401']
            ],
            // Add more days as needed
        ];
    }
}