<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\EventController as PublicEventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExploreController;
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

Route::get('/sejarah', function () {
    return view('sejarah');
})->name('sejarah');

Route::get('/visi-misi', function () {
    return view('visi-misi');
})->name('visi-misi');

Route::get('/struktur-organisasi', function () {
    return view('struktur-organisasi');
})->name('struktur-organisasi');

// Individual Unit Pages
Route::get('/tk-al-munawwar', function () {
    return view('tk-al-munawwar');
})->name('tk-al-munawwar');

Route::get('/sd-al-munawwar', function () {
    return view('sd-al-munawwar');
})->name('sd-al-munawwar');

Route::get('/panti-al-munawwar', function () {
    return view('panti-al-munawwar');
})->name('panti-al-munawwar');

Route::get('/masjid-al-munawwar', function () {
    return view('masjid-al-munawwar');
})->name('masjid-al-munawwar');

Route::get('/berita', [PublicNewsController::class, 'index'])->name('berita');

Route::get('/berita/{slug}', [PublicNewsController::class, 'show'])->name('berita.detail');

// Public Events
Route::get('/acara', [PublicEventController::class, 'index'])->name('acara');
Route::get('/acara/{event}', [PublicEventController::class, 'show'])->name('acara.detail');

Route::get('/explore/fasilitas', [ExploreController::class, 'fasilitas'])->name('explore.fasilitas');
Route::get('/explore/extrakurikuler', [ExploreController::class, 'extrakurikuler'])->name('explore.extrakurikuler');
Route::get('/explore/islamic-life', [ExploreController::class, 'islamicLife'])->name('explore.islamic-life');
Route::get('/explore/school-life', [ExploreController::class, 'schoolLife'])->name('explore.school-life');

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
