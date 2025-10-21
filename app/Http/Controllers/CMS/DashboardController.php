<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentRegistration;
use App\Models\ContactUs;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Display the main CMS dashboard
     */
    public function index()
    {
        $stats = [
            'student_registrations' => StudentRegistration::count(),
            'contact_messages' => ContactUs::count(),
        ];

        return view('cms.dashboard.index', compact('stats'));
    }

    /**
     * Display the content management dashboard for editors
     */
    public function content()
    {
        $stats = [
            'student_registrations' => StudentRegistration::count(),
            'contact_messages' => ContactUs::count(),
        ];

        return view('cms.dashboard.content', compact('stats'));
    }

    /**
     * Export dashboard report
     */
    public function exportReport()
    {
        $stats = [
            'student_registrations' => StudentRegistration::count(),
            'contact_messages' => ContactUs::count(),
        ];

        // Generate CSV content
        $csvContent = "Report Type,Count\n";
        $csvContent .= "Student Registrations,{$stats['student_registrations']}\n";
        $csvContent .= "Contact Messages,{$stats['contact_messages']}\n";

        $filename = 'dashboard_report_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
