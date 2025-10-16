<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\News;
use App\Models\Homepage;
use App\Models\FoundationValue;
use App\Models\Program;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display the homepage with cached banners and latest published news.
     */
    public function index()
    {
        $banners = Cache::remember('home_banners', 300, function () {
            try {
                return Banner::latest()->get();
            } catch (\Throwable $e) {
                Log::warning('Failed to load banners for homepage: ' . $e->getMessage());
                return collect();
            }
        });

        $latestNews = Cache::remember('home_latest_news', 300, function () {
            try {
                return News::query()
                    ->published()
                    ->orderBy('created_at', 'desc')
                    ->with('createdBy')
                    ->take(3)
                    ->get(['id','title','slug','summary','image_url','published_at','created_at','created_by','category','status']);
            } catch (\Throwable $e) {
                Log::warning('Failed to load latest news for homepage: ' . $e->getMessage());
                return collect();
            }
        });

        // Programs for Courses section
        $programs = Cache::remember('home_programs', 300, function () {
            try {
                return Program::query()
                    ->orderBy('created_at', 'desc')
                    ->take(4)
                    ->get(['id','title','name','slug','description','photo_url']);
            } catch (\Throwable $e) {
                Log::warning('Failed to load programs for homepage: ' . $e->getMessage());
                return collect();
            }
        });

        // Homepage general info and foundation values
        $homepage = Cache::remember('public_homepage', 300, function () {
            try {
                return Homepage::first();
            } catch (\Throwable $e) {
                Log::warning('Failed to load homepage record: ' . $e->getMessage());
                return null;
            }
        });

        if (!$homepage) {
            // No homepage record yet; view will render with defaults
            Log::info('Homepage record not found; rendering with defaults.');
        }

        $foundationValues = Cache::remember('public_homepage_foundation_values', 300, function () use ($homepage) {
            try {
                if (!$homepage) {
                    return collect();
                }
                return FoundationValue::query()
                    ->where('homepage_id', $homepage->id)
                    ->orderBy('created_at', 'desc')
                    ->get(['id','icon','title','description']);
            } catch (\Throwable $e) {
                Log::warning('Failed to load foundation values for homepage: ' . $e->getMessage());
                return collect();
            }
        });

        return view('home', compact('banners', 'latestNews', 'homepage', 'foundationValues', 'programs'));
    }
}