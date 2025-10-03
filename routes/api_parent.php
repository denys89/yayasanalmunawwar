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
    // Add email existence check endpoint
    Route::post('check-email', [AuthController::class, 'checkEmail']);
});

// Public Routes for Registration
Route::prefix('admission-waves')->group(function () {
    Route::get('by-level', [\App\Http\Controllers\CMS\AdmissionWaveController::class, 'getByLevel']);
});

// Registration validation routes (Public)
Route::prefix('registration')->group(function () {
    // Expose registration endpoints under parent namespace for the public registration flow
    Route::post('/', [\App\Http\Controllers\API\RegistrationController::class, 'store'])
        ->name('parent.registration.store');
    Route::get('success', [\App\Http\Controllers\API\RegistrationController::class, 'success'])
        ->name('parent.registration.success');
    Route::post('validate-step', [\App\Http\Controllers\API\RegistrationController::class, 'validateStep'])
        ->name('parent.registration.validate-step');
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
        // Map overview to index for aggregated data
        Route::get('overview', [DashboardController::class, 'index']);
        Route::get('attendance-stats', [DashboardController::class, 'getAttendanceStats']);
        Route::get('payment-overview', [DashboardController::class, 'getPaymentOverview']);
        Route::get('announcements', [DashboardController::class, 'getAnnouncements']);
    });

    // Students
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index']);
        Route::get('{id}', [StudentController::class, 'show']);
        Route::get('{id}/attendance', [StudentController::class, 'attendance']);
        Route::get('{id}/grades', [StudentController::class, 'grades']);
        Route::get('{id}/report-card', [StudentController::class, 'reportCard']);
        Route::get('{id}/schedule', [StudentController::class, 'schedule']);
    });

    // Payments
    Route::prefix('payments')->group(function () {
        Route::get('overview', [PaymentController::class, 'index']);
        Route::get('history', [PaymentController::class, 'getPaymentHistory']);
        Route::get('{id}', [PaymentController::class, 'show']);
        Route::get('{id}/invoice', [PaymentController::class, 'downloadInvoice']);
        // Transfer proof upload and viewing
        Route::post('{id}/upload-transfer-proof', [PaymentController::class, 'uploadTransferProof']);
        Route::get('{id}/view-transfer-proof', [PaymentController::class, 'viewTransferProof']);
        Route::get('stats', [PaymentController::class, 'getPaymentStats']);
        Route::post('process', [PaymentController::class, 'processPayment']);
    });

    // Announcements
    Route::prefix('announcements')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index']);
        Route::get('{id}', [AnnouncementController::class, 'show']);
        Route::get('urgent', [AnnouncementController::class, 'getUrgent']);
        Route::get('categories', [AnnouncementController::class, 'getCategories']);
        Route::get('unread-count', [AnnouncementController::class, 'getUnreadCount']);
        Route::post('{id}/mark-read', [AnnouncementController::class, 'markAsRead']);
        Route::get('{id}/attachments/{attachmentId}', [AnnouncementController::class, 'downloadAttachment']);
    });

    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('profile', [SettingsController::class, 'profile']);
        Route::put('profile', [SettingsController::class, 'updateProfile']);
        Route::get('notifications', [SettingsController::class, 'notifications']);
        Route::put('notifications', [SettingsController::class, 'updateNotifications']);
        Route::get('privacy', [SettingsController::class, 'privacy']);
        Route::put('privacy', [SettingsController::class, 'updatePrivacy']);
        Route::get('security', [SettingsController::class, 'security']);
        Route::get('students', [SettingsController::class, 'students']);
        Route::put('change-password', [SettingsController::class, 'changePassword']);
        Route::get('preferences', [SettingsController::class, 'preferences']);
        Route::put('preferences', [SettingsController::class, 'updatePreferences']);
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