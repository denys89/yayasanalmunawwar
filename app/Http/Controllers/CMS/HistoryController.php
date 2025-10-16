<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    /**
     * Show the History page (single record) with Milestones tab.
     */
    public function index(Request $request)
    {
        $history = History::first();
        if (!$history) {
            $history = History::create([
                'name' => 'Foundation History',
                'title' => 'Our Journey',
                'description' => '',
                'banner' => null,
                'image' => null,
                'image_description' => null,
            ]);
        }

        $query = Milestone::where('history_id', $history->id);

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        $sort = $request->get('sort', 'created_at');
        $dir = $request->get('dir', 'desc');
        if (!in_array($sort, ['title', 'created_at', 'updated_at'])) {
            $sort = 'created_at';
        }
        if (!in_array(strtolower($dir), ['asc', 'desc'])) {
            $dir = 'desc';
        }
        $query->orderBy($sort, $dir);

        $milestones = $query->paginate(10)->withQueryString();

        return view('cms.history.index', compact('history', 'milestones', 'search', 'sort', 'dir'));
    }

    /**
     * Update the single History record (update-only).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image_description' => 'nullable|string|max:255',
        ]);

        $history = History::first();
        if (!$history) {
            $history = History::create([]);
        }

        if ($request->hasFile('banner')) {
            if ($history->banner && !str_starts_with($history->banner, 'http')) {
                Storage::disk('public')->delete($history->banner);
            }
            $path = $request->file('banner')->store('history/banners', 'public');
            $validated['banner'] = $path;
        }

        if ($request->hasFile('image')) {
            if ($history->image && !str_starts_with($history->image, 'http')) {
                Storage::disk('public')->delete($history->image);
            }
            $path = $request->file('image')->store('history/images', 'public');
            $validated['image'] = $path;
        }

        $history->update($validated);

        return redirect()->route('cms.history.index')->with('success', 'History updated successfully.');
    }
}