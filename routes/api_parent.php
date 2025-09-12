<?php

use App\Http\Controllers\ParentPortal\AuthController;
use App\Http\Controllers\ParentPortal\DashboardController;
use App\Http\Controllers\ParentPortal\StudentController;
use App\Http\Controllers\ParentPortal\PaymentController;
use App\Http\Controllers\ParentPortal\AnnouncementController;
use App\Http\Controllers\ParentPortal\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Parent Portal API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for the Parent Portal.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group and "parent" prefix.
|
*/

// Authentication Routes (Public)
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

// Protected Routes (Require Authentication)
Route::middleware(['auth:sanctum', 'parent.access'])->group(function () {
    
    // Authentication
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
    
    // Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('attendance-stats', [DashboardController::class, 'getAttendanceStats']);
        Route::get('payment-overview', [DashboardController::class, 'getPaymentOverview']);
        Route::get('announcements', [DashboardController::class, 'getAnnouncements']);
    });
    
    // Students
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index']);
        Route::get('{student}', [StudentController::class, 'show']);
        Route::get('{student}/attendance', [StudentController::class, 'getAttendance']);
        Route::get('{student}/grades', [StudentController::class, 'getGrades']);
        Route::get('{student}/schedule', [StudentController::class, 'getSchedule']);
        Route::get('{student}/report-card', [StudentController::class, 'downloadReportCard']);
    });
    
    // Payments
    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::get('history', [PaymentController::class, 'getPaymentHistory']);
        Route::get('stats', [PaymentController::class, 'getPaymentStats']);
        Route::get('reminders', [PaymentController::class, 'getReminders']);
        Route::get('{payment}', [PaymentController::class, 'show']);
        Route::get('{payment}/invoice', [PaymentController::class, 'downloadInvoice']);
        Route::post('process', [PaymentController::class, 'processPayment']);
    });
    
    // Announcements
    Route::prefix('announcements')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index']);
        Route::get('urgent', [AnnouncementController::class, 'getUrgent']);
        Route::get('categories', [AnnouncementController::class, 'getCategories']);
        Route::get('unread-count', [AnnouncementController::class, 'getUnreadCount']);
        Route::get('stats', [AnnouncementController::class, 'getStats']);
        Route::get('{announcement}', [AnnouncementController::class, 'show']);
        Route::post('{announcement}/mark-read', [AnnouncementController::class, 'markAsRead']);
        Route::post('mark-multiple-read', [AnnouncementController::class, 'markMultipleAsRead']);
        Route::get('{announcement}/attachments/{attachment}', [AnnouncementController::class, 'downloadAttachment']);
        
        // Notification preferences
        Route::get('notification-preferences', [AnnouncementController::class, 'getNotificationPreferences']);
        Route::put('notification-preferences', [AnnouncementController::class, 'updateNotificationPreferences']);
    });
    
    // Settings & Profile
    Route::prefix('settings')->group(function () {
        // Profile Management
        Route::get('profile', [SettingsController::class, 'getProfile']);
        Route::put('profile', [SettingsController::class, 'updateProfile']);
        Route::post('change-password', [SettingsController::class, 'changePassword']);
        
        // Notification Preferences
        Route::get('notifications', [SettingsController::class, 'getNotificationPreferences']);
        Route::put('notifications', [SettingsController::class, 'updateNotificationPreferences']);
        
        // Privacy Settings
        Route::get('privacy', [SettingsController::class, 'getPrivacySettings']);
        Route::put('privacy', [SettingsController::class, 'updatePrivacySettings']);
        
        // Security
        Route::get('security', [SettingsController::class, 'getSecurityInfo']);
        Route::post('two-factor', [SettingsController::class, 'toggleTwoFactor']);
        
        // Students Management
        Route::get('students', [SettingsController::class, 'getConnectedStudents']);
        Route::post('students/add-request', [SettingsController::class, 'requestAddStudent']);
        
        // App Preferences
        Route::get('preferences', [SettingsController::class, 'getAppPreferences']);
        Route::put('preferences', [SettingsController::class, 'updateAppPreferences']);
        
        // Account Management
        Route::post('delete-account', [SettingsController::class, 'deleteAccount']);
        Route::get('export-data', [SettingsController::class, 'exportData']);
    });
});

// Health Check Route
Route::get('health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'Parent Portal API',
        'version' => '1.0.0',
        'timestamp' => now()->toISOString()
    ]);
});

// API Documentation Route
Route::get('docs', function () {
    return response()->json([
        'message' => 'Parent Portal API Documentation',
        'version' => '1.0.0',
        'endpoints' => [
            'auth' => [
                'POST /auth/login' => 'Parent login',
                'POST /auth/logout' => 'Parent logout',
                'GET /auth/user' => 'Get authenticated parent',
                'POST /auth/forgot-password' => 'Send password reset link',
                'POST /auth/reset-password' => 'Reset password'
            ],
            'dashboard' => [
                'GET /dashboard' => 'Get dashboard overview',
                'GET /dashboard/attendance-stats' => 'Get attendance statistics',
                'GET /dashboard/payment-overview' => 'Get payment overview',
                'GET /dashboard/announcements' => 'Get recent announcements'
            ],
            'students' => [
                'GET /students' => 'Get all parent students',
                'GET /students/{id}' => 'Get student details',
                'GET /students/{id}/attendance' => 'Get student attendance',
                'GET /students/{id}/grades' => 'Get student grades',
                'GET /students/{id}/schedule' => 'Get student schedule',
                'GET /students/{id}/report-card' => 'Download report card'
            ],
            'payments' => [
                'GET /payments' => 'Get payment overview',
                'GET /payments/history' => 'Get payment history',
                'GET /payments/stats' => 'Get payment statistics',
                'GET /payments/{id}' => 'Get payment details',
                'POST /payments/process' => 'Process online payment'
            ],
            'announcements' => [
                'GET /announcements' => 'Get all announcements',
                'GET /announcements/urgent' => 'Get urgent announcements',
                'GET /announcements/{id}' => 'Get announcement details',
                'POST /announcements/{id}/mark-read' => 'Mark as read'
            ],
            'settings' => [
                'GET /settings/profile' => 'Get parent profile',
                'PUT /settings/profile' => 'Update parent profile',
                'POST /settings/change-password' => 'Change password',
                'GET /settings/notifications' => 'Get notification preferences',
                'PUT /settings/notifications' => 'Update notification preferences'
            ]
        ]
    ]);
});