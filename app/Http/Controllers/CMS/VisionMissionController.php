<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use App\Models\Mission;
use App\Models\CoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisionMissionController extends Controller
{
    /**
     * Show the Vision & Mission page (single record) with Missions and Core Values tabs.
     */
    public function index(Request $request)
    {
        $visionMission = VisionMission::first();
        if (!$visionMission) {
            $visionMission = VisionMission::create([
                'name' => 'Vision & Mission',
                'title' => 'Our Vision & Mission',
                'description' => '',
                'banner' => null,
                'image' => null,
                'our_vision' => null,
                'quran_quote' => null,
            ]);
        }

        $missions = Mission::where('vision_mission_id', $visionMission->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $coreValues = CoreValue::where('vision_mission_id', $visionMission->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cms.vision-mission.index', compact('visionMission', 'missions', 'coreValues'));
    }

    /**
     * Update the single Vision & Mission record (update-only).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'our_vision' => 'nullable|string',
            'quran_quote' => 'nullable|string',
        ]);

        $visionMission = VisionMission::first();
        if (!$visionMission) {
            $visionMission = VisionMission::create([]);
        }

        if ($request->hasFile('banner')) {
            if ($visionMission->banner && !str_starts_with($visionMission->banner, 'http')) {
                Storage::disk('public')->delete($visionMission->banner);
            }
            $path = $request->file('banner')->store('vision-mission/banners', 'public');
            $validated['banner'] = $path;
        }

        if ($request->hasFile('image')) {
            if ($visionMission->image && !str_starts_with($visionMission->image, 'http')) {
                Storage::disk('public')->delete($visionMission->image);
            }
            $path = $request->file('image')->store('vision-mission/images', 'public');
            $validated['image'] = $path;
        }

        $visionMission->update($validated);

        return redirect()->route('cms.vision_mission.index')->with('success', 'Vision & Mission updated successfully.');
    }
}