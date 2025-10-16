<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\FoundationValue;
use App\Models\Homepage;
use Illuminate\Http\Request;

class FoundationValueController extends Controller
{
    /**
     * Store a newly created Foundation Value linked to the Homepage.
     */
    public function store(Request $request)
    {
        $homepage = Homepage::firstOrCreate([], [
            'title' => 'Homepage',
            'description' => '',
            'photo' => null,
            'photo_title' => null,
        ]);

        $validated = $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $validated['homepage_id'] = $homepage->id;

        FoundationValue::create($validated);

        return redirect()->route('cms.homepage.index')->with('success', 'Foundation Value added successfully.');
    }

    /**
     * Update the specified Foundation Value.
     */
    public function update(Request $request, FoundationValue $foundationValue)
    {
        $validated = $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $foundationValue->update($validated);

        return redirect()->route('cms.homepage.index')->with('success', 'Foundation Value updated successfully.');
    }

    /**
     * Remove the specified Foundation Value from storage.
     */
    public function destroy(FoundationValue $foundationValue)
    {
        $foundationValue->delete();
        return redirect()->route('cms.homepage.index')->with('success', 'Foundation Value deleted successfully.');
    }
}