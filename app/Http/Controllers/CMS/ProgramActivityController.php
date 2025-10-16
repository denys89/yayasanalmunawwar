<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramActivity;
use Illuminate\Http\Request;

class ProgramActivityController extends Controller
{
    public function index(Program $program)
    {
        $activities = $program->activities()->latest()->get();
        return view('cms.programs.activities.index', compact('program', 'activities'));
    }

    public function store(Request $request, Program $program)
    {
        $validated = $request->validate([
            'fa_icon' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $program->activities()->create($validated);

        return back()->with('success', 'Activity added.');
    }

    public function update(Request $request, Program $program, ProgramActivity $activity)
    {
        abort_unless($activity->program_id === $program->id, 404);

        $validated = $request->validate([
            'fa_icon' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $activity->update($validated);

        return back()->with('success', 'Activity updated.');
    }

    public function destroy(Program $program, ProgramActivity $activity)
    {
        abort_unless($activity->program_id === $program->id, 404);
        $activity->delete();
        return back()->with('success', 'Activity deleted.');
    }
}