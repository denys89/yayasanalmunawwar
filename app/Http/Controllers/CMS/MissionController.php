<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Store a new mission under the single Vision & Mission.
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
        Mission::create($validated);

        return redirect()->route('cms.vision_mission.index')->with('success', 'Mission added successfully.');
    }

    /**
     * Update an existing mission.
     */
    public function update(Request $request, Mission $mission)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $mission->update($validated);

        return redirect()->route('cms.vision_mission.index')->with('success', 'Mission updated successfully.');
    }

    /**
     * Delete a mission.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('cms.vision_mission.index')->with('success', 'Mission deleted successfully.');
    }
}