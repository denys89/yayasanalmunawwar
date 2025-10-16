<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use App\Models\CoreValue;
use Illuminate\Http\Request;

class CoreValueController extends Controller
{
    /**
     * Store a new core value under the single Vision & Mission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $visionMission = VisionMission::first();
        if (!$visionMission) {
            $visionMission = VisionMission::create([
                'name' => 'Vision & Mission',
                'title' => 'Our Vision & Mission',
            ]);
        }

        $validated['vision_mission_id'] = $visionMission->id;
        CoreValue::create($validated);

        return redirect()->route('cms.vision_mission.index')->with('success', 'Core value added successfully.');
    }

    /**
     * Update an existing core value.
     */
    public function update(Request $request, CoreValue $coreValue)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $coreValue->update($validated);

        return redirect()->route('cms.vision_mission.index')->with('success', 'Core value updated successfully.');
    }

    /**
     * Delete a core value.
     */
    public function destroy(CoreValue $coreValue)
    {
        $coreValue->delete();
        return redirect()->route('cms.vision_mission.index')->with('success', 'Core value deleted successfully.');
    }
}