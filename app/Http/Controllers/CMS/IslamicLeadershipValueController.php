<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use App\Models\IslamicLeadershipValue;
use Illuminate\Http\Request;

class IslamicLeadershipValueController extends Controller
{
    /**
     * Store a new Islamic leadership value.
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
        IslamicLeadershipValue::create($validated);

        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership value added successfully.');
    }

    /**
     * Update an existing Islamic leadership value.
     */
    public function update(Request $request, IslamicLeadershipValue $value)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $value->update($validated);

        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership value updated successfully.');
    }

    /**
     * Delete an Islamic leadership value.
     */
    public function destroy(IslamicLeadershipValue $value)
    {
        $value->delete();
        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership value deleted successfully.');
    }
}