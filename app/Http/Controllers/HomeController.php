<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\News;
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

        return view('home', compact('banners', 'latestNews'));
    }
}