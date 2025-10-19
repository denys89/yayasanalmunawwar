<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\EventController as PublicEventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\PublicHistoryController;
use App\Http\Controllers\PublicVisionMissionController;
use App\Http\Controllers\PublicOrganizationalStructureController;
use App\Http\Controllers\PublicProgramController;
// Removed model and cache imports from routes; moved to HomeController
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/hubungi-kami', function () {
    return view('hubungi-kami');
})->name('hubungi-kami');

// Secure Contact form submission
Route::post('/hubungi-kami', [ContactController::class, 'store'])
    ->name('hubungi-kami.submit')
    ->middleware(['throttle:10,1']);

Route::get('/sejarah', [PublicHistoryController::class, 'show'])->name('sejarah');

Route::get('/visi-misi', [PublicVisionMissionController::class, 'show'])->name('visi-misi');

Route::get('/struktur-organisasi', [PublicOrganizationalStructureController::class, 'show'])->name('struktur-organisasi');

// Legacy unit routes removed; use /programs/{slug}

Route::get('/berita', [PublicNewsController::class, 'index'])->name('berita');

Route::get('/berita/{slug}', [PublicNewsController::class, 'show'])->name('berita.detail');

// Public Events
Route::get('/acara', [PublicEventController::class, 'index'])->name('acara');
Route::get('/acara/{event}', [PublicEventController::class, 'show'])->name('acara.detail');

// Single dynamic route for all explore pages
Route::get('/explore/{slug}', [ExploreController::class, 'show'])->name('explore.show');

// Web Dashboard route (for default Laravel UI components)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Public News Routes
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Individual Unit Pages via dynamic slug
Route::get('/programs/{slug}', [PublicProgramController::class, 'show'])->name('programs.show');
