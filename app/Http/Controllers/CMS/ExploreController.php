<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Explore;
use Illuminate\Support\Str;

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
            'category' => 'required|in:facilities,extracurriculars',
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

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
            'category' => 'required|in:facilities,extracurriculars',
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

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
