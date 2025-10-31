<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramTestimony;
use Illuminate\Http\Request;

class ProgramTestimonyController extends Controller
{
    public function index(Program $program)
    {
        $testimonies = $program->testimonies()->latest()->get();
        return view('cms.programs.testimonies.index', compact('program', 'testimonies'));
    }

    public function store(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'from' => 'required|string|max:255',
            'ideal' => 'required|string|max:255',
            'testimony' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_visible' => 'boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonies/photos', 'public');
        }

        // Set default value for is_visible if not provided
        $validated['is_visible'] = $validated['is_visible'] ?? true;

        $program->testimonies()->create($validated);

        return back()->with('success', 'Testimony added.');
    }

    public function update(Request $request, Program $program, ProgramTestimony $testimony)
    {
        abort_unless($testimony->program_id === $program->id, 404);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'from' => 'required|string|max:255',
            'ideal' => 'required|string|max:255',
            'testimony' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_visible' => 'boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($testimony->photo && \Storage::disk('public')->exists($testimony->photo)) {
                \Storage::disk('public')->delete($testimony->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonies/photos', 'public');
        }

        // Set default value for is_visible if not provided
        $validated['is_visible'] = $validated['is_visible'] ?? true;

        $testimony->update($validated);

        return back()->with('success', 'Testimony updated.');
    }

    public function toggleVisibility(Program $program, ProgramTestimony $testimony)
    {
        abort_unless($testimony->program_id === $program->id, 404);
        
        $testimony->update(['is_visible' => !$testimony->is_visible]);
        
        $status = $testimony->is_visible ? 'visible' : 'hidden';
        return back()->with('success', "Testimony is now {$status}.");
    }

    public function destroy(Program $program, ProgramTestimony $testimony)
    {
        abort_unless($testimony->program_id === $program->id, 404);
        
        // Delete photo if exists
        if ($testimony->photo && \Storage::disk('public')->exists($testimony->photo)) {
            \Storage::disk('public')->delete($testimony->photo);
        }
        
        $testimony->delete();
        return back()->with('success', 'Testimony deleted.');
    }
}