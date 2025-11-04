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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $os = OrganizationalStructure::first();
        if (!$os) {
            $os = OrganizationalStructure::create([
                'name' => 'Organizational Structure',
                'title' => 'Foundation Organizational Structure',
            ]);
        }

        $data = [
            'organizational_structure_id' => $os->id,
            'title' => $validated['title'],
            'position' => $validated['position'],
        ];

        // Handle photo upload
        try {
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('organizational-structure/leadership', 'public');
                $data['photo'] = $path;
            }
        } catch (\Throwable $e) {
            return redirect()->route('cms.organizational_structure.index')
                ->with('error', 'Upload foto gagal: ' . $e->getMessage());
        }

        FoundationLeadershipStructure::create($data);

        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership structure added successfully.');
    }

    /**
     * Update an existing foundation leadership structure item.
     */
    public function update(Request $request, FoundationLeadershipStructure $leadership)
    {
        $validated = $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $data = [
            'title' => $validated['title'],
            'position' => $validated['position'],
        ];

        try {
            if ($request->hasFile('photo')) {
                // delete old photo if local
                if ($leadership->photo && !str_starts_with($leadership->photo, 'http')) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($leadership->photo);
                }
                $path = $request->file('photo')->store('organizational-structure/leadership', 'public');
                $data['photo'] = $path;
            }
        } catch (\Throwable $e) {
            return redirect()->route('cms.organizational_structure.index')
                ->with('error', 'Upload foto gagal saat pembaruan: ' . $e->getMessage());
        }

        $leadership->update($data);

        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership structure updated successfully.');
    }

    /**
     * Delete a foundation leadership structure item.
     */
    public function destroy(FoundationLeadershipStructure $leadership)
    {
        // Remove associated photo if stored locally
        try {
            if ($leadership->photo && !str_starts_with($leadership->photo, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($leadership->photo);
            }
        } catch (\Throwable $e) {
            // Log error silently; proceed with deleting DB record
            \Illuminate\Support\Facades\Log::error('Failed deleting leadership photo: ' . $e->getMessage());
        }

        $leadership->delete();
        return redirect()->route('cms.organizational_structure.index')->with('success', 'Leadership structure deleted successfully.');
    }
}