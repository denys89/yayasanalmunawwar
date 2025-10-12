<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PublicNewsController extends Controller
{
    /**
     * Display a listing of published news to the public.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        try {
            $validated = $request->validate([
                'q' => 'nullable|string|min:2|max:100',
            ]);

            $q = isset($validated['q']) ? $validated['q'] : null;
            if (is_string($q)) {
                $q = trim(preg_replace('/[\x00-\x1F\x7F]/u', '', $q));
            }

            $news = News::query()
                ->published()
                ->orderBy('created_at', 'desc')
                ->with('createdBy')
                ->when($q, function ($query) use ($q) {
                    $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
                    $query->where(function ($qb) use ($like) {
                        $qb->where('title', 'like', $like)
                           ->orWhere('summary', 'like', $like)
                           ->orWhere('content', 'like', $like);
                    });
                })
                ->paginate(9, ['id','title','slug','summary','image_url','published_at','created_at','category','status','created_by'])
                ->withQueryString();

            $categories = News::query()
                ->select('category')
                ->whereNotNull('category')
                ->distinct()
                ->pluck('category');
        } catch (\Throwable $e) {
            Log::warning('Failed to load berita list: ' . $e->getMessage());
            $news = null;
            $categories = collect();
            $q = null;
        }

        return view('berita', [
            'news' => $news,
            'categories' => $categories,
            'query' => $q,
        ]);
    }

    /**
     * Display the specified published news to the public.
     */
    public function show(string $slug)
    {
        try {
            $news = News::query()
                ->with('createdBy')
                ->where('slug', $slug)
                ->first();
        } catch (\Throwable $e) {
            Log::warning('Failed to load berita detail: ' . $e->getMessage());
            $news = null;
        }

        $latestNews = Cache::remember('berita_latest_news', 300, function () use ($news) {
            try {
                $query = News::query()
                    ->orderBy('published_at', 'desc')
                    ->orderBy('created_at', 'desc');
                if ($news) {
                    $query->where('id', '!=', $news->id);
                }
                return $query->take(5)->get(['id','title','slug','image_url','published_at','created_at','category','status']);
            } catch (\Throwable $e) {
                Log::warning('Failed to load latest news for sidebar: ' . $e->getMessage());
                return collect();
            }
        });

        return view('berita-detail', compact('news', 'latestNews'));
    }
}