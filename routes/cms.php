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
use App\Http\Controllers\CMS\DiscountController;
use App\Http\Controllers\CMS\ContactUsController;
use App\Http\Controllers\CMS\EventController;
use App\Http\Controllers\CMS\BannerController;
use App\Http\Controllers\CMS\ProgramFacilityController;
use App\Http\Controllers\CMS\ProgramEducationController;
use App\Http\Controllers\CMS\ProgramServiceController;
use App\Http\Controllers\CMS\ProgramDonationController;
use App\Http\Controllers\CMS\ProgramActivityController;
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

// CMS Routes with Admin Middleware
Route::prefix('cms')->name('cms.')->middleware(['auth', 'admin'])->group(function () {
    
    // CMS Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reports Export
    Route::get('/reports/export', [DashboardController::class, 'exportReport'])->name('reports.export');
    
    // Pages Management
    Route::resource('pages', PageController::class);
    
    // Programs Management
    Route::resource('programs', ProgramController::class);
    // Program Facilities (nested under program)
    Route::prefix('programs/{program}')->name('programs.')->group(function () {
        Route::get('facilities', [ProgramFacilityController::class, 'index'])->name('facilities.index');
        Route::post('facilities', [ProgramFacilityController::class, 'store'])->name('facilities.store');
        Route::patch('facilities/{facility}', [ProgramFacilityController::class, 'update'])->name('facilities.update');
        Route::delete('facilities/{facility}', [ProgramFacilityController::class, 'destroy'])->name('facilities.destroy');

        // Program Educations
        Route::get('educations', [ProgramEducationController::class, 'index'])->name('educations.index');
        Route::post('educations', [ProgramEducationController::class, 'store'])->name('educations.store');
        Route::patch('educations/{education}', [ProgramEducationController::class, 'update'])->name('educations.update');
        Route::delete('educations/{education}', [ProgramEducationController::class, 'destroy'])->name('educations.destroy');

        // Program Services
        Route::get('services', [ProgramServiceController::class, 'index'])->name('services.index');
        Route::post('services', [ProgramServiceController::class, 'store'])->name('services.store');
        Route::patch('services/{service}', [ProgramServiceController::class, 'update'])->name('services.update');
        Route::delete('services/{service}', [ProgramServiceController::class, 'destroy'])->name('services.destroy');

        // Program Donations
        Route::get('donations', [ProgramDonationController::class, 'index'])->name('donations.index');
        Route::post('donations', [ProgramDonationController::class, 'store'])->name('donations.store');
        Route::patch('donations/{donation}', [ProgramDonationController::class, 'update'])->name('donations.update');
        Route::delete('donations/{donation}', [ProgramDonationController::class, 'destroy'])->name('donations.destroy');

        // Program Activities
        Route::get('activities', [ProgramActivityController::class, 'index'])->name('activities.index');
        Route::post('activities', [ProgramActivityController::class, 'store'])->name('activities.store');
        Route::patch('activities/{activity}', [ProgramActivityController::class, 'update'])->name('activities.update');
        Route::delete('activities/{activity}', [ProgramActivityController::class, 'destroy'])->name('activities.destroy');
    });
    
    // Explore Management
    Route::resource('explores', ExploreController::class);
    Route::prefix('explores/{explore}')->name('explores.')->group(function () {
        Route::post('images', [ExploreImageController::class, 'store'])->name('images.store');
        Route::patch('images/{image}', [ExploreImageController::class, 'update'])->name('images.update');
        Route::delete('images/{image}', [ExploreImageController::class, 'destroy'])->name('images.destroy');
    });
    
    // News Management
    Route::resource('news', NewsController::class);

    // Events Management
    Route::resource('events', EventController::class);

    // Banners Management
    Route::resource('banners', BannerController::class)->except(['show']);
    Route::delete('banners/{banner}/force', [BannerController::class, 'forceDelete'])->name('banners.force-delete');
    Route::patch('banners/{banner}/restore', [BannerController::class, 'restore'])->name('banners.restore');
    
    // Admissions module removed
    
    // Admission Waves Management
    Route::resource('admission-waves', AdmissionWaveController::class)->parameters([
        'admission-waves' => 'admission_wave'
    ]);
    Route::post('admission-waves/check-overlap', [AdmissionWaveController::class, 'checkOverlap'])->name('admission-waves.check-overlap');
    
    // Student Registrations Management
    Route::resource('student-registrations', StudentRegistrationController::class)->parameters([
        'student-registrations' => 'student_registration'
    ])->only(['index', 'show', 'update']);
    
    // Payment Management Routes
    Route::post('student-registrations/{payment}/upload-transfer-proof', [StudentRegistrationController::class, 'uploadTransferProof'])
        ->name('student-registrations.upload-transfer-proof');
    Route::put('student-registrations/{payment}/update-payment-status', [StudentRegistrationController::class, 'updatePaymentStatus'])
        ->name('student-registrations.update-payment-status');
    Route::get('student-registrations/{payment}/view-transfer-proof', [StudentRegistrationController::class, 'viewTransferProof'])
        ->name('student-registrations.view-transfer-proof');
    
    // Media Management
    Route::resource('media', MediaController::class);
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    
    // FAQs Management
    Route::resource('faqs', FaqController::class);

    // Contact Us Management (read-only)
    Route::resource('contact-us', ContactUsController::class)->only(['index', 'show'])->parameters([
        'contact-us' => 'contactUs'
    ]);
    Route::get('contact-us/export/csv', [ContactUsController::class, 'export'])->name('contact-us.export');
    
    // Discounts Management
    Route::resource('discounts', DiscountController::class);
    
    // Settings Management
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    // History Management (single record) with Milestones
    Route::get('history', [HistoryController::class, 'index'])->name('history.index');
    Route::put('history', [HistoryController::class, 'update'])->name('history.update');
    Route::post('history/milestones', [MilestoneController::class, 'store'])->name('history.milestones.store');
    Route::patch('history/milestones/{milestone}', [MilestoneController::class, 'update'])->name('history.milestones.update');
    Route::delete('history/milestones/{milestone}', [MilestoneController::class, 'destroy'])->name('history.milestones.destroy');

    // Vision & Mission Management (single record) with Missions and Core Values
    Route::get('vision-mission', [VisionMissionController::class, 'index'])->name('vision_mission.index');
    Route::put('vision-mission', [VisionMissionController::class, 'update'])->name('vision_mission.update');
    // Missions (nested under Vision & Mission)
    Route::post('vision-mission/missions', [MissionController::class, 'store'])->name('vision_mission.missions.store');
    Route::patch('vision-mission/missions/{mission}', [MissionController::class, 'update'])->name('vision_mission.missions.update');
    Route::delete('vision-mission/missions/{mission}', [MissionController::class, 'destroy'])->name('vision_mission.missions.destroy');
    // Core Values (nested under Vision & Mission)
    Route::post('vision-mission/core-values', [CoreValueController::class, 'store'])->name('vision_mission.core_values.store');
    Route::patch('vision-mission/core-values/{coreValue}', [CoreValueController::class, 'update'])->name('vision_mission.core_values.update');
    Route::delete('vision-mission/core-values/{coreValue}', [CoreValueController::class, 'destroy'])->name('vision_mission.core_values.destroy');

    // Homepage Management (single record) with Foundation Values
    Route::get('homepage', [HomepageController::class, 'index'])->name('homepage.index');
    Route::put('homepage', [HomepageController::class, 'update'])->name('homepage.update');
    // Foundation Values (nested under Homepage)
    Route::post('homepage/foundation-values', [FoundationValueController::class, 'store'])->name('homepage.foundation_values.store');
    Route::patch('homepage/foundation-values/{foundationValue}', [FoundationValueController::class, 'update'])->name('homepage.foundation_values.update');
    Route::delete('homepage/foundation-values/{foundationValue}', [FoundationValueController::class, 'destroy'])->name('homepage.foundation_values.destroy');

    // Organizational Structure Management (single record) with Leadership Structures and Values
    Route::get('organizational-structure', [OrganizationalStructureController::class, 'index'])->name('organizational_structure.index');
    Route::put('organizational-structure', [OrganizationalStructureController::class, 'update'])->name('organizational_structure.update');
    // Foundation Leadership Structures
    Route::post('organizational-structure/foundation-leadership-structures', [FoundationLeadershipStructureController::class, 'store'])->name('organizational_structure.foundation_leadership_structures.store');
    Route::patch('organizational-structure/foundation-leadership-structures/{leadership}', [FoundationLeadershipStructureController::class, 'update'])->name('organizational_structure.foundation_leadership_structures.update');
    Route::delete('organizational-structure/foundation-leadership-structures/{leadership}', [FoundationLeadershipStructureController::class, 'destroy'])->name('organizational_structure.foundation_leadership_structures.destroy');
    // Islamic Leadership Values
    Route::post('organizational-structure/islamic-leadership-values', [IslamicLeadershipValueController::class, 'store'])->name('organizational_structure.islamic_leadership_values.store');
    Route::patch('organizational-structure/islamic-leadership-values/{value}', [IslamicLeadershipValueController::class, 'update'])->name('organizational_structure.islamic_leadership_values.update');
    Route::delete('organizational-structure/islamic-leadership-values/{value}', [IslamicLeadershipValueController::class, 'destroy'])->name('organizational_structure.islamic_leadership_values.destroy');
    
    // Users Management (Admin only)
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::patch('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('users/{user}/login-as', [UserController::class, 'loginAs'])->name('users.login-as');
    Route::post('users/bulk', [UserController::class, 'bulk'])->name('users.bulk');
});

// CMS Routes with Editor Middleware (for content editors)
Route::prefix('cms')->name('cms.')->middleware(['auth', 'editor'])->group(function () {
    
    // Content Management for Editors
    Route::get('content', [DashboardController::class, 'content'])->name('content');
    
    // Editor-specific routes are moved under an extra URI prefix to avoid conflicts with admin resource routes
    Route::prefix('editor')->group(function () {
        // Pages Management (Editor access)
        Route::get('pages', [PageController::class, 'index'])->name('pages.editor.index');
        Route::get('pages/create', [PageController::class, 'create'])->name('pages.editor.create');
        Route::post('pages', [PageController::class, 'store'])->name('pages.editor.store');
        Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.editor.edit');
        Route::patch('pages/{page}', [PageController::class, 'update'])->name('pages.editor.update');
        
        // News Management (Editor access)
        Route::get('news', [NewsController::class, 'index'])->name('news.editor.index');
        Route::get('news/create', [NewsController::class, 'create'])->name('news.editor.create');
        Route::post('news', [NewsController::class, 'store'])->name('news.editor.store');
        Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.editor.edit');
        Route::patch('news/{news}', [NewsController::class, 'update'])->name('news.editor.update');
        
        // Media Management (Editor access)
        Route::get('media', [MediaController::class, 'index'])->name('media.editor.index');
        Route::post('media/upload', [MediaController::class, 'upload'])->name('media.editor.upload');

        // Banners (Editor access limited to index/create/store/edit/update)
        Route::get('banners', [BannerController::class, 'index'])->name('banners.editor.index');
        Route::get('banners/create', [BannerController::class, 'create'])->name('banners.editor.create');
        Route::post('banners', [BannerController::class, 'store'])->name('banners.editor.store');
        Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.editor.edit');
        Route::patch('banners/{banner}', [BannerController::class, 'update'])->name('banners.editor.update');
    });
});