<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with(['createdBy', 'updatedBy'])->latest()->paginate(10);
        return view('cms.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'summary' => 'nullable|string|max:1000',
            'category' => 'required|in:news,event,coverage',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'published_at' => 'nullable|date',
            'status' => 'nullable|in:draft,published',
            'action' => 'nullable|in:save,publish',
        ]);

        // Generate slug from provided slug or title
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Derive status from action if provided
        if ($request->has('action')) {
            if ($request->action === 'publish') {
                $validated['status'] = 'published';
                // Set published_at if not provided
                if (empty($validated['published_at'])) {
                    $validated['published_at'] = now();
                }
            } else {
                $validated['status'] = 'draft';
            }
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $validated['image_url'] = $path;
        }

        // Set created_by and updated_by to current user
        $userId = $request->user()->id;
        $validated['created_by'] = $userId;
        $validated['updated_by'] = $userId;

        News::create($validated);

        // Invalidate homepage latest news cache
        Cache::forget('home_latest_news');

        return redirect()->route('cms.news.index')
            ->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $news->load(['createdBy', 'updatedBy']);
        return view('cms.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $news->load(['createdBy', 'updatedBy']);
        return view('cms.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'summary' => 'nullable|string|max:1000',
            'category' => 'required|in:news,event,coverage',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'published_at' => 'nullable|date',
            'status' => 'nullable|in:draft,published',
            'action' => 'nullable|in:save,publish',
        ]);

        // Generate slug from provided slug or title
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Derive status from action if provided
        if ($request->has('action')) {
            if ($request->action === 'publish') {
                $validated['status'] = 'published';
                if (empty($validated['published_at'])) {
                    $validated['published_at'] = now();
                }
            } else {
                $validated['status'] = 'draft';
            }
        }

        if ($request->hasFile('image')) {
            // Delete old image if it's a stored path
            if ($news->image_url && !str_starts_with($news->image_url, 'http')) {
                Storage::disk('public')->delete($news->image_url);
            }
            $path = $request->file('image')->store('news', 'public');
            $validated['image_url'] = $path;
        }

        // Update updated_by to current user
        $validated['updated_by'] = $request->user()->id;
        $news->update($validated);

        // Invalidate homepage latest news cache
        Cache::forget('home_latest_news');

        return redirect()->route('cms.news.index')
            ->with('success', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        // Invalidate homepage latest news cache
        Cache::forget('home_latest_news');

        return redirect()->route('cms.news.index')
            ->with('success', 'News deleted successfully.');
    }
}
