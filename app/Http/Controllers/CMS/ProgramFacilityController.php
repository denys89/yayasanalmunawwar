<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramFacility;
use Illuminate\Http\Request;

class ProgramFacilityController extends Controller
{
    public function index(Program $program)
    {
        $facilities = $program->facilities()->latest()->get();
        return view('cms.programs.facilities.index', compact('program', 'facilities'));
    }

    public function store(Request $request, Program $program)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:64',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $program->facilities()->create($validated);

        return back()->with('success', 'Facility added.');
    }

    public function update(Request $request, Program $program, ProgramFacility $facility)
    {
        // Ensure facility belongs to program
        abort_unless($facility->program_id === $program->id, 404);

        $validated = $request->validate([
            'icon' => 'required|string|max:64',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility->update($validated);

        return back()->with('success', 'Facility updated.');
    }

    public function destroy(Program $program, ProgramFacility $facility)
    {
        abort_unless($facility->program_id === $program->id, 404);
        $facility->delete();
        return back()->with('success', 'Facility deleted.');
    }
}