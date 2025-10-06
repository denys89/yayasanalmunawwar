<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Banner::query();
        $showTrashed = request()->boolean('trashed');

        if ($showTrashed) {
            $query = $query->onlyTrashed();
        } else {
            $query = $query->latest();
        }

        $banners = $query->paginate(10)->appends(['trashed' => $showTrashed ? 1 : null]);
        return view('cms.banners.index', compact('banners', 'showTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_label' => 'nullable|string|max:255',
            'cta' => 'nullable|string|max:2048',
        ], [
            'image.required' => 'Banner image is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Only JPG, PNG, or WEBP images are allowed.',
            // Optional: If you later add min dimensions, adjust message accordingly
            // 'image.dimensions' => 'Image must meet minimum size requirements.',
            'title.required' => 'Title is required.',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
        }

        $banner = Banner::create([
            'image' => $path,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'button_label' => $validated['button_label'] ?? null,
            'cta' => $validated['cta'] ?? null,
        ]);

        return redirect()->route('cms.banners.index')->with('success', 'Banner created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('cms.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_label' => 'nullable|string|max:255',
            'cta' => 'nullable|string|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->image = $request->file('image')->store('banners', 'public');
        }

        $banner->title = $validated['title'];
        $banner->subtitle = $validated['subtitle'] ?? null;
        $banner->button_label = $validated['button_label'] ?? null;
        $banner->cta = $validated['cta'] ?? null;
        $banner->save();

        return redirect()->route('cms.banners.index')->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Soft delete
        $banner->delete();
        return redirect()->route('cms.banners.index')->with('success', 'Banner deleted successfully.');
    }

    /**
     * Restore a soft-deleted banner.
     */
    public function restore($id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
        if ($banner->trashed()) {
            $banner->restore();
            return redirect()->route('cms.banners.index', ['trashed' => 1])->with('success', 'Banner restored successfully.');
        }
        return redirect()->route('cms.banners.index')->with('info', 'Banner is not deleted.');
    }

    /**
     * Permanently delete banner and associated image.
     */
    public function forceDelete($id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->forceDelete();
        return redirect()->route('cms.banners.index')->with('success', 'Banner permanently deleted.');
    }
}