<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\PageController;
use App\Http\Controllers\CMS\ProgramController;
use App\Http\Controllers\CMS\ExploreController;
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
    
    // Redirect root CMS to pages
    Route::get('/', function () {
        return redirect()->route('cms.pages.index');
    })->name('dashboard');
    
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
    });
    
    // Explore Management
    Route::resource('explores', ExploreController::class);
    
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