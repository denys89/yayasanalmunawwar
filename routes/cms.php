<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\PageController;
use App\Http\Controllers\CMS\ProgramController;
use App\Http\Controllers\CMS\ExploreController;
use App\Http\Controllers\CMS\NewsController;
use App\Http\Controllers\CMS\AdmissionController;
use App\Http\Controllers\CMS\MediaController;
use App\Http\Controllers\CMS\FaqController;
use App\Http\Controllers\CMS\SettingController;
use App\Http\Controllers\CMS\UserController;

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
    
    // Explore Management
    Route::resource('explores', ExploreController::class);
    
    // News Management
    Route::resource('news', NewsController::class);
    
    // Admissions Management
    Route::resource('admissions', AdmissionController::class);
    Route::patch('admissions/{admission}/verify', [AdmissionController::class, 'verify'])->name('admissions.verify');
    Route::patch('admissions/{admission}/reject', [AdmissionController::class, 'reject'])->name('admissions.reject');
    
    // Media Management
    Route::resource('media', MediaController::class);
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    
    // FAQs Management
    Route::resource('faqs', FaqController::class);
    
    // Settings Management
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Users Management (Admin only)
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::patch('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
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
    });
});