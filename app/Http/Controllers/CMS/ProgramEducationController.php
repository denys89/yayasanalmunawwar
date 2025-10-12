<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramEducation;
use Illuminate\Http\Request;

class ProgramEducationController extends Controller
{
    public function index(Program $program)
    {
        $educations = $program->educations()->latest()->get();
        return view('cms.programs.educations.index', compact('program', 'educations'));
    }

    public function store(Request $request, Program $program)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:64',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $program->educations()->create($validated);

        return back()->with('success', 'Education item added.');
    }

    public function update(Request $request, Program $program, ProgramEducation $education)
    {
        // Ensure education belongs to program
        abort_unless($education->program_id === $program->id, 404);

        $validated = $request->validate([
            'icon' => 'required|string|max:64',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $education->update($validated);

        return back()->with('success', 'Education item updated.');
    }

    public function destroy(Program $program, ProgramEducation $education)
    {
        abort_unless($education->program_id === $program->id, 404);
        $education->delete();
        return back()->with('success', 'Education item deleted.');
    }
}