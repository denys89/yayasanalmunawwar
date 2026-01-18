<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\PageController;
use App\Http\Controllers\CMS\ProgramController;
use App\Http\Controllers\CMS\ExploreController;
use App\Http\Controllers\CMS\ExploreImageController;
use App\Http\Controllers\CMS\NewsController;
use App\Http\Controllers\CMS\AdmissionWaveController;
use App\Http\Controllers\CMS\StudentRegistrationController;
use App\Http\Controllers\CMS\MediaController;
use App\Http\Controllers\CMS\FaqController;
use App\Http\Controllers\CMS\SettingController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\RoleController;
use App\Http\Controllers\CMS\DiscountController;
use App\Http\Controllers\CMS\ContactUsController;
use App\Http\Controllers\CMS\EventController;
use App\Http\Controllers\CMS\BannerController;
use App\Http\Controllers\CMS\ProgramFacilityController;
use App\Http\Controllers\CMS\ProgramEducationController;
use App\Http\Controllers\CMS\ProgramServiceController;
use App\Http\Controllers\CMS\ProgramDonationController;
use App\Http\Controllers\CMS\ProgramActivityController;
use App\Http\Controllers\CMS\ProgramTestimonyController;
use App\Http\Controllers\CMS\HistoryController;
use App\Http\Controllers\CMS\MilestoneController;
use App\Http\Controllers\CMS\VisionMissionController;
use App\Http\Controllers\CMS\MissionController;
use App\Http\Controllers\CMS\CoreValueController;
use App\Http\Controllers\CMS\OrganizationalStructureController;
use App\Http\Controllers\CMS\FoundationLeadershipStructureController;
use App\Http\Controllers\CMS\IslamicLeadershipValueController;
use App\Http\Controllers\CMS\HomepageController;
use App\Http\Controllers\CMS\FoundationValueController;


/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register CMS routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// CMS Routes - All authenticated users
Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    
    // Root CMS path redirects to dashboard
    Route::get('/', function () {
        return redirect()->route('cms.dashboard');
    });
    
    // Dashboard - Available to all authenticated CMS users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reports Export
    Route::get('/reports/export', [DashboardController::class, 'exportReport'])
        ->middleware('permission:export-data')
        ->name('reports.export');
    
    // =====================================================
    // WEBSITE CONTENT
    // =====================================================
    
    // Homepage Management
    Route::middleware('permission:edit-homepage')->group(function () {
        Route::get('homepage', [HomepageController::class, 'index'])->name('homepage.index');
        Route::put('homepage', [HomepageController::class, 'update'])->name('homepage.update');
        Route::post('homepage/foundation-values', [FoundationValueController::class, 'store'])->name('homepage.foundation_values.store');
        Route::patch('homepage/foundation-values/{foundationValue}', [FoundationValueController::class, 'update'])->name('homepage.foundation_values.update');
        Route::delete('homepage/foundation-values/{foundationValue}', [FoundationValueController::class, 'destroy'])->name('homepage.foundation_values.destroy');
    });
    
    // Banners Management
    Route::middleware('permission:manage-banners')->group(function () {
        Route::resource('banners', BannerController::class)->except(['show']);
        Route::delete('banners/{banner}/force', [BannerController::class, 'forceDelete'])->name('banners.force-delete');
        Route::patch('banners/{banner}/restore', [BannerController::class, 'restore'])->name('banners.restore');
    });
    
    // Pages Management
    Route::middleware('permission:manage-pages')->group(function () {
        Route::resource('pages', PageController::class);
    });
    
    // =====================================================
    // ABOUT SECTION
    // =====================================================
    
    // History Management
    Route::middleware('permission:manage-history')->group(function () {
        Route::get('history', [HistoryController::class, 'index'])->name('history.index');
        Route::put('history', [HistoryController::class, 'update'])->name('history.update');
        Route::post('history/milestones', [MilestoneController::class, 'store'])->name('history.milestones.store');
        Route::patch('history/milestones/{milestone}', [MilestoneController::class, 'update'])->name('history.milestones.update');
        Route::delete('history/milestones/{milestone}', [MilestoneController::class, 'destroy'])->name('history.milestones.destroy');
    });
    
    // Vision & Mission Management
    Route::middleware('permission:manage-vision-mission')->group(function () {
        Route::get('vision-mission', [VisionMissionController::class, 'index'])->name('vision_mission.index');
        Route::put('vision-mission', [VisionMissionController::class, 'update'])->name('vision_mission.update');
        Route::post('vision-mission/missions', [MissionController::class, 'store'])->name('vision_mission.missions.store');
        Route::patch('vision-mission/missions/{mission}', [MissionController::class, 'update'])->name('vision_mission.missions.update');
        Route::delete('vision-mission/missions/{mission}', [MissionController::class, 'destroy'])->name('vision_mission.missions.destroy');
        Route::post('vision-mission/core-values', [CoreValueController::class, 'store'])->name('vision_mission.core_values.store');
        Route::patch('vision-mission/core-values/{coreValue}', [CoreValueController::class, 'update'])->name('vision_mission.core_values.update');
        Route::delete('vision-mission/core-values/{coreValue}', [CoreValueController::class, 'destroy'])->name('vision_mission.core_values.destroy');
    });
    
    // Organizational Structure Management
    Route::middleware('permission:manage-organizational-structure')->group(function () {
        Route::get('organizational-structure', [OrganizationalStructureController::class, 'index'])->name('organizational_structure.index');
        Route::put('organizational-structure', [OrganizationalStructureController::class, 'update'])->name('organizational_structure.update');
        Route::post('organizational-structure/foundation-leadership-structures', [FoundationLeadershipStructureController::class, 'store'])->name('organizational_structure.foundation_leadership_structures.store');
        Route::patch('organizational-structure/foundation-leadership-structures/{leadership}', [FoundationLeadershipStructureController::class, 'update'])->name('organizational_structure.foundation_leadership_structures.update');
        Route::delete('organizational-structure/foundation-leadership-structures/{leadership}', [FoundationLeadershipStructureController::class, 'destroy'])->name('organizational_structure.foundation_leadership_structures.destroy');
        Route::post('organizational-structure/islamic-leadership-values', [IslamicLeadershipValueController::class, 'store'])->name('organizational_structure.islamic_leadership_values.store');
        Route::patch('organizational-structure/islamic-leadership-values/{value}', [IslamicLeadershipValueController::class, 'update'])->name('organizational_structure.islamic_leadership_values.update');
        Route::delete('organizational-structure/islamic-leadership-values/{value}', [IslamicLeadershipValueController::class, 'destroy'])->name('organizational_structure.islamic_leadership_values.destroy');
    });
    
    // =====================================================
    // PROGRAMS & CONTENT
    // =====================================================
    
    // Programs Management
    Route::middleware('permission:manage-programs')->group(function () {
        Route::resource('programs', ProgramController::class);
        Route::prefix('programs/{program}')->name('programs.')->group(function () {
            Route::get('facilities', [ProgramFacilityController::class, 'index'])->name('facilities.index');
            Route::post('facilities', [ProgramFacilityController::class, 'store'])->name('facilities.store');
            Route::patch('facilities/{facility}', [ProgramFacilityController::class, 'update'])->name('facilities.update');
            Route::delete('facilities/{facility}', [ProgramFacilityController::class, 'destroy'])->name('facilities.destroy');

            Route::get('educations', [ProgramEducationController::class, 'index'])->name('educations.index');
            Route::post('educations', [ProgramEducationController::class, 'store'])->name('educations.store');
            Route::patch('educations/{education}', [ProgramEducationController::class, 'update'])->name('educations.update');
            Route::delete('educations/{education}', [ProgramEducationController::class, 'destroy'])->name('educations.destroy');

            Route::get('services', [ProgramServiceController::class, 'index'])->name('services.index');
            Route::post('services', [ProgramServiceController::class, 'store'])->name('services.store');
            Route::patch('services/{service}', [ProgramServiceController::class, 'update'])->name('services.update');
            Route::delete('services/{service}', [ProgramServiceController::class, 'destroy'])->name('services.destroy');

            Route::get('donations', [ProgramDonationController::class, 'index'])->name('donations.index');
            Route::post('donations', [ProgramDonationController::class, 'store'])->name('donations.store');
            Route::patch('donations/{donation}', [ProgramDonationController::class, 'update'])->name('donations.update');
            Route::delete('donations/{donation}', [ProgramDonationController::class, 'destroy'])->name('donations.destroy');

            Route::get('activities', [ProgramActivityController::class, 'index'])->name('activities.index');
            Route::post('activities', [ProgramActivityController::class, 'store'])->name('activities.store');
            Route::patch('activities/{activity}', [ProgramActivityController::class, 'update'])->name('activities.update');
            Route::delete('activities/{activity}', [ProgramActivityController::class, 'destroy'])->name('activities.destroy');

            Route::get('testimonies', [ProgramTestimonyController::class, 'index'])->name('testimonies.index');
            Route::post('testimonies', [ProgramTestimonyController::class, 'store'])->name('testimonies.store');
            Route::patch('testimonies/{testimony}', [ProgramTestimonyController::class, 'update'])->name('testimonies.update');
            Route::patch('testimonies/{testimony}/toggle-visibility', [ProgramTestimonyController::class, 'toggleVisibility'])->name('testimonies.toggle-visibility');
            Route::delete('testimonies/{testimony}', [ProgramTestimonyController::class, 'destroy'])->name('testimonies.destroy');
        });
    });
    
    // Explore Management
    Route::middleware('permission:manage-explores')->group(function () {
        Route::resource('explores', ExploreController::class);
        Route::prefix('explores/{explore}')->name('explores.')->group(function () {
            Route::post('images', [ExploreImageController::class, 'store'])->name('images.store');
            Route::patch('images/{image}', [ExploreImageController::class, 'update'])->name('images.update');
            Route::delete('images/{image}', [ExploreImageController::class, 'destroy'])->name('images.destroy');
        });
    });
    
    // News Management
    Route::middleware('role_or_permission:create-news|edit-news')->group(function () {
        Route::resource('news', NewsController::class);
    });
    
    // Events Management
    Route::middleware('permission:manage-events')->group(function () {
        Route::resource('events', EventController::class);
    });
    
    // Media Management
    Route::middleware('permission:manage-media')->group(function () {
        Route::resource('media', MediaController::class);
        Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    });
    
    // =====================================================
    // ADMISSIONS
    // =====================================================
    
    // Admission Waves Management
    Route::middleware('permission:manage-admission-waves')->group(function () {
        Route::resource('admission-waves', AdmissionWaveController::class)->parameters([
            'admission-waves' => 'admission_wave'
        ]);
        Route::post('admission-waves/check-overlap', [AdmissionWaveController::class, 'checkOverlap'])->name('admission-waves.check-overlap');
    });
    
    // Student Registrations Management
    Route::middleware('permission:view-registrations')->group(function () {
        Route::resource('student-registrations', StudentRegistrationController::class)->parameters([
            'student-registrations' => 'student_registration'
        ])->except(['edit', 'destroy']);
        
        // Payment Management Routes
        Route::post('student-registrations/{student_registration}/payments', [StudentRegistrationController::class, 'storePayment'])
            ->name('student-registrations.store-payment');
        Route::post('student-registrations/{payment}/upload-transfer-proof', [StudentRegistrationController::class, 'uploadTransferProof'])
            ->name('student-registrations.upload-transfer-proof');
        Route::put('student-registrations/{payment}/update-payment-status', [StudentRegistrationController::class, 'updatePaymentStatus'])
            ->name('student-registrations.update-payment-status');
        Route::get('student-registrations/{payment}/view-transfer-proof', [StudentRegistrationController::class, 'viewTransferProof'])
            ->name('student-registrations.view-transfer-proof');
    });
    
    // Students Management
    Route::middleware('permission:view-students')->group(function () {
        Route::resource('students', \App\Http\Controllers\CMS\StudentController::class);
    });
    
    // Discounts Management
    Route::middleware('permission:manage-discounts')->group(function () {
        Route::resource('discounts', DiscountController::class);
    });
    
    // Monthly Payments Management
    Route::middleware('permission:manage-payments')->group(function () {
        Route::get('monthly-payments/search-students', [\App\Http\Controllers\CMS\MonthlyPaymentController::class, 'searchStudents'])
            ->name('monthly-payments.search-students');
        Route::resource('monthly-payments', \App\Http\Controllers\CMS\MonthlyPaymentController::class);
        Route::post('monthly-payments/{monthlyPayment}/confirm', [\App\Http\Controllers\CMS\MonthlyPaymentController::class, 'confirm'])
            ->name('monthly-payments.confirm');
    });
    
    // =====================================================
    // SUPPORT
    // =====================================================
    
    // FAQs Management
    Route::middleware('permission:manage-faqs')->group(function () {
        Route::resource('faqs', FaqController::class);
    });
    
    // Contact Us Management
    Route::middleware('permission:view-contact-us')->group(function () {
        Route::resource('contact-us', ContactUsController::class)->only(['index', 'show'])->parameters([
            'contact-us' => 'contactUs'
        ]);
        Route::get('contact-us/export/csv', [ContactUsController::class, 'export'])->name('contact-us.export');
    });
    
    // =====================================================
    // ADMINISTRATION
    // =====================================================
    
    // Users Management
    Route::middleware('permission:manage-users')->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
        Route::patch('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
        Route::patch('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
        Route::post('users/{user}/login-as', [UserController::class, 'loginAs'])->name('users.login-as');
        Route::post('users/bulk', [UserController::class, 'bulk'])->name('users.bulk');
    });
    
    // Roles & Permissions Management
    Route::middleware('permission:manage-roles')->group(function () {
        Route::resource('roles', RoleController::class);
    });
    
    // Settings Management
    Route::middleware('permission:manage-settings')->group(function () {
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});