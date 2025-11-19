<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Explore;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\TinyMCEHelper;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $explores = Explore::latest()->paginate(10);
        return view('cms.explores.index', compact('explores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.explores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:facility,extracurricular',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'image_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Sanitize rich text fields
        if (!empty($validated['summary'])) {
            $validated['summary'] = TinyMCEHelper::sanitizeContent($validated['summary']);
        }
        $validated['content'] = TinyMCEHelper::sanitizeContent($validated['content']);

        $validated['slug'] = Str::slug($validated['title']);

        // Determine status based on action buttons
        $action = $request->input('action');
        $validated['status'] = $action === 'publish' ? 'published' : 'draft';

        // If a file is uploaded, store it and set image_url to stored path
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('explores', 'public');
            $validated['image_url'] = $path;
        }

        // If a banner is uploaded, store it and set banner_url to stored path
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('explores/banners', 'public');
            $validated['banner_url'] = $path;
        }

        Explore::create($validated);

        return redirect()->route('cms.explores.index')
            ->with('success', 'Explore content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Explore $explore)
    {
        return view('cms.explores.show', compact('explore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Explore $explore)
    {
        return view('cms.explores.edit', compact('explore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Explore $explore)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:facility,extracurricular',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'image_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Sanitize rich text fields
        if (!empty($validated['summary'])) {
            $validated['summary'] = TinyMCEHelper::sanitizeContent($validated['summary']);
        }
        $validated['content'] = TinyMCEHelper::sanitizeContent($validated['content']);

        $validated['slug'] = Str::slug($validated['title']);

        // Determine status based on action buttons; keep current if none provided
        $action = $request->input('action');
        if ($action === 'publish') {
            $validated['status'] = 'published';
        } elseif ($action === 'save') {
            $validated['status'] = 'draft';
        }

        // If a new file is uploaded, delete old stored file (if local) and set new path
        if ($request->hasFile('image')) {
            if ($explore->image_url && !str_starts_with($explore->image_url, 'http')) {
                Storage::disk('public')->delete($explore->image_url);
            }
            $path = $request->file('image')->store('explores', 'public');
            $validated['image_url'] = $path;
        }

        // If a new banner is uploaded, delete old stored file (if local) and set new path
        if ($request->hasFile('banner')) {
            if ($explore->banner_url && !str_starts_with($explore->banner_url, 'http')) {
                Storage::disk('public')->delete($explore->banner_url);
            }
            $path = $request->file('banner')->store('explores/banners', 'public');
            $validated['banner_url'] = $path;
        }

        $explore->update($validated);

        return redirect()->route('cms.explores.index')
            ->with('success', 'Explore content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Explore $explore)
    {
        $explore->delete();

        return redirect()->route('cms.explores.index')
            ->with('success', 'Explore content deleted successfully.');
    }
}
