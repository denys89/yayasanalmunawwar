<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    /**
     * Store a new milestone under the single History.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $history = History::first();
        if (!$history) {
            $history = History::create([
                'name' => 'Foundation History',
                'title' => 'Our Journey',
            ]);
        }

        $validated['history_id'] = $history->id;
        Milestone::create($validated);

        return redirect()->route('cms.history.index')->with('success', 'Milestone added successfully.');
    }

    /**
     * Update an existing milestone.
     */
    public function update(Request $request, Milestone $milestone)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $milestone->update($validated);

        return redirect()->route('cms.history.index')->with('success', 'Milestone updated successfully.');
    }

    /**
     * Delete a milestone.
     */
    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return redirect()->route('cms.history.index')->with('success', 'Milestone deleted successfully.');
    }
}