<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use App\Models\FoundationValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    /**
     * Display the Homepage CMS page (single record) with Foundation Values tab.
     */
    public function index(Request $request)
    {
        $homepage = Homepage::first();
        if (!$homepage) {
            $homepage = Homepage::create([
                'title' => 'Homepage',
                'description' => '',
                'photo' => null,
                'photo_title' => null,
            ]);
        }

        $foundationValues = FoundationValue::where('homepage_id', $homepage->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cms.homepage.index', compact('homepage', 'foundationValues'));
    }

    /**
     * Update the single Homepage record.
     */
    public function update(Request $request)
    {
        $homepage = Homepage::firstOrCreate([], [
            'title' => 'Homepage',
            'description' => '',
            'photo' => null,
            'photo_title' => null,
        ]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photo_title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'], // up to ~5MB
        ]);

        if ($request->hasFile('photo')) {
            // Optional: delete old photo
            if ($homepage->photo && Storage::disk('public')->exists($homepage->photo)) {
                Storage::disk('public')->delete($homepage->photo);
            }
            $path = $request->file('photo')->store('homepage/photos', 'public');
            $validated['photo'] = $path;
        }

        $homepage->update($validated);

        return redirect()->route('cms.homepage.index')->with('success', 'Homepage updated successfully.');
    }
}