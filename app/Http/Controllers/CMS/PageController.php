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
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|url',
            'show_in_menu' => 'nullable|boolean',
            'menu_order' => 'nullable|integer|min:0',
            'type' => 'required|in:about,vision_mission,career,faq',
            'status' => 'nullable|in:draft,published',
        ]);

        // Handle action parameter from form buttons
        if ($request->has('action')) {
            if ($request->action === 'save') {
                $validated['status'] = 'draft';
                $validated['is_published'] = false;
            } elseif ($request->action === 'publish') {
                $validated['status'] = 'published';
                $validated['is_published'] = true;
                $validated['published_at'] = now();
            }
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Handle checkbox values
        $validated['show_in_menu'] = $request->has('show_in_menu');

        Page::create($validated);

        $message = $validated['status'] === 'published' ? 'Page created and published successfully.' : 'Page created as draft successfully.';

        return redirect()->route('cms.pages.index')
            ->with('success', $message);
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
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|url',
            'show_in_menu' => 'nullable|boolean',
            'menu_order' => 'nullable|integer|min:0',
            'type' => 'required|in:about,vision_mission,career,faq',
            'status' => 'nullable|in:draft,published',
        ]);

        // Handle action parameter from form buttons
        if ($request->has('action')) {
            if ($request->action === 'save') {
                $validated['status'] = 'draft';
                $validated['is_published'] = false;
            } elseif ($request->action === 'publish') {
                $validated['status'] = 'published';
                $validated['is_published'] = true;
                $validated['published_at'] = now();
            }
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Handle checkbox values
        $validated['show_in_menu'] = $request->has('show_in_menu');

        $page->update($validated);

        $message = $validated['status'] === 'published' ? 'Page updated and published successfully.' : 'Page updated as draft successfully.';

        return redirect()->route('cms.pages.index')
            ->with('success', $message);
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
