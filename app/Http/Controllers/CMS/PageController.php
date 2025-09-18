<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('cms.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:about,vision_mission,career,faq',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Page::create($validated);

        return redirect()->route('cms.pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('cms.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('cms.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:about,vision_mission,career,faq',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $page->update($validated);

        return redirect()->route('cms.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('cms.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
