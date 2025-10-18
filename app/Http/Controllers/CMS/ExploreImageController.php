<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Explore;
use App\Models\ExploreImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExploreImageController extends Controller
{
    public function store(Request $request, Explore $explore)
    {
        $validated = $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,webp|max:5120',
            'caption' => 'nullable|string|max:300',
        ]);

        $path = $request->file('image')->store('explores/images', 'public');

        $explore->images()->create([
            'image_url' => $path,
            'caption' => $validated['caption'] ?? null,
        ]);

        return back()->with('success', 'Image added successfully.');
    }

    public function update(Request $request, Explore $explore, ExploreImage $image)
    {
        abort_unless($image->explore_id === $explore->id, 404);

        $validated = $request->validate([
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'caption' => 'nullable|string|max:300',
        ]);

        if ($request->hasFile('image')) {
            if ($image->image_url) {
                Storage::disk('public')->delete($image->image_url);
            }
            $path = $request->file('image')->store('explores/images', 'public');
            $image->image_url = $path;
        }

        $image->caption = $validated['caption'] ?? null;
        $image->save();

        return back()->with('success', 'Image updated successfully.');
    }

    public function destroy(Explore $explore, ExploreImage $image)
    {
        abort_unless($image->explore_id === $explore->id, 404);

        if ($image->image_url) {
            Storage::disk('public')->delete($image->image_url);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}