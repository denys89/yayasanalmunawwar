<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/hubungi-kami', function () {
    return view('hubungi-kami');
})->name('hubungi-kami');

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

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/berita/{slug}', function ($slug) {
    // For now, return view with sample data
    // In the future, this will fetch actual news data from database
    $news = (object) [
        'title' => 'Program Pendidikan Al-Quran untuk Anak-Anak',
        'content' => 'Yayasan Al-Munawwar dengan bangga mengumumkan peluncuran program pendidikan Al-Quran khusus untuk anak-anak. Program ini dirancang dengan metode pembelajaran yang menyenangkan dan interaktif.',
        'author_name' => 'Admin Yayasan',
        'author_title' => 'Administrator',
        'author_bio' => 'Tim admin Yayasan Al-Munawwar yang berkomitmen untuk menyebarkan informasi dan kegiatan yayasan kepada masyarakat luas.',
        'created_at' => now(),
        'comments_count' => 0,
        'category' => 'Pendidikan',
        'tags' => 'Pendidikan,Al-Quran,Anak-anak,Program',
        'featured_image' => null,
        'author_avatar' => null,
        'slug' => $slug
    ];
    return view('berita-detail', compact('news'));
})->name('berita.detail');

Route::get('/acara', function () {
    return view('acara');
})->name('acara');

Route::get('/acara/{slug}', function ($slug) {
    // For now, return view with sample data
    // In the future, this will fetch actual event data from database
    $event = (object) [
        'title' => 'Kajian Rutin Tafsir Al-Quran',
        'description' => 'Kajian rutin tafsir Al-Quran merupakan program unggulan Yayasan Al-Munawwar yang dilaksanakan setiap minggu. Kajian ini dirancang untuk memberikan pemahaman yang mendalam tentang makna dan hikmah yang terkandung dalam Al-Quran.',
        'event_date' => now()->addDays(7),
        'event_time' => '09:00 WIB',
        'location' => 'Masjid Al-Munawwar',
        'organizer' => 'Yayasan Al-Munawwar',
        'contact_person' => '+62 21 1234 5678',
        'price' => null,
        'capacity' => null,
        'featured_image' => null,
        'slug' => $slug
    ];
    return view('acara-detail', compact('event'));
})->name('acara.detail');


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
