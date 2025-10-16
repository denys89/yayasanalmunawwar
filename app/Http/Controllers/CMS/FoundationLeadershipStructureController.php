<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use App\Models\FoundationLeadershipStructure;
use Illuminate\Http\Request;

class FoundationLeadershipStructureController extends Controller
{
    /**
     * Store a new foundation leadership structure item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $os = OrganizationalStructure::first();
        if (!$os) {
            $os = OrganizationalStructure::create([
                'name' => 'Organizational Structure',
                'title' => 'Foundation Organizational Structure',
            ]);
        }

        $validated['organizational_structure_id'] = $os->id;
        FoundationLeadershipStructure::create($validated);

        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership structure added successfully.');
    }

    /**
     * Update an existing foundation leadership structure item.
     */
    public function update(Request $request, FoundationLeadershipStructure $leadership)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $leadership->update($validated);

        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership structure updated successfully.');
    }

    /**
     * Delete a foundation leadership structure item.
     */
    public function destroy(FoundationLeadershipStructure $leadership)
    {
        $leadership->delete();
        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership structure deleted successfully.');
    }
}