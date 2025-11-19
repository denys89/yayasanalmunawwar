<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use App\Models\FoundationLeadershipStructure;
use App\Models\IslamicLeadershipValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationalStructureController extends Controller
{
    /**
     * Display the Organizational Structure page (single record) with related tabs.
     */
    public function index(Request $request)
    {
        $organizationalStructure = OrganizationalStructure::first();
        if (!$organizationalStructure) {
            $organizationalStructure = OrganizationalStructure::create([
                'name' => 'Organizational Structure',
                'title' => 'Foundation Organizational Structure',
                'description' => '',
                'banner' => null,
                'image' => null,
                'governance_principles' => null,
                'quran_quote' => null,
            ]);
        }

        // Separate foundation and school leadership structures
        $foundationLeadershipStructures = FoundationLeadershipStructure::where('organizational_structure_id', $organizationalStructure->id)
            ->where('type', FoundationLeadershipStructure::TYPE_FOUNDATION)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'foundation_page');

        $schoolLeadershipStructures = FoundationLeadershipStructure::where('organizational_structure_id', $organizationalStructure->id)
            ->where('type', FoundationLeadershipStructure::TYPE_SCHOOL)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'school_page');

        $leadershipValues = IslamicLeadershipValue::where('organizational_structure_id', $organizationalStructure->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cms.organizational-structure.index', compact(
            'organizationalStructure', 
            'foundationLeadershipStructures', 
            'schoolLeadershipStructures', 
            'leadershipValues'
        ));
    }

    /**
     * Update the single Organizational Structure record.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'governance_principles' => 'nullable|string',
            'quran_quote' => 'nullable|string',
        ]);

        $organizationalStructure = OrganizationalStructure::first();
        if (!$organizationalStructure) {
            $organizationalStructure = OrganizationalStructure::create([]);
        }

        if ($request->hasFile('banner')) {
            if ($organizationalStructure->banner && !str_starts_with($organizationalStructure->banner, 'http')) {
                Storage::disk('public')->delete($organizationalStructure->banner);
            }
            $path = $request->file('banner')->store('organizational-structure/banners', 'public');
            $validated['banner'] = $path;
        }

        if ($request->hasFile('image')) {
            if ($organizationalStructure->image && !str_starts_with($organizationalStructure->image, 'http')) {
                Storage::disk('public')->delete($organizationalStructure->image);
            }
            $path = $request->file('image')->store('organizational-structure/images', 'public');
            $validated['image'] = $path;
        }

        $organizationalStructure->update($validated);

        return redirect()->route('cms.organizational_structure.index')->with('success', 'Organizational Structure updated successfully.');
    }
}