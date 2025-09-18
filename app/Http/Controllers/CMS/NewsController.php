<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
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
            'content' => 'required|string',
            'category' => 'required|in:news,event,coverage',
            'image_url' => 'nullable|url',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        News::create($validated);

        return redirect()->route('cms.news.index')
            ->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('cms.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('cms.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:news,event,coverage',
            'image_url' => 'nullable|url',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $news->update($validated);

        return redirect()->route('cms.news.index')
            ->with('success', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('cms.news.index')
            ->with('success', 'News deleted successfully.');
    }
}
