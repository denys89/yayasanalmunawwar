<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramService;
use Illuminate\Http\Request;

class ProgramServiceController extends Controller
{
    public function index(Program $program)
    {
        $services = $program->services()->latest()->get();
        return view('cms.programs.services.index', compact('program', 'services'));
    }

    public function store(Request $request, Program $program)
    {
        $validated = $request->validate([
            'fa_icon' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $program->services()->create($validated);

        return back()->with('success', 'Service added.');
    }

    public function update(Request $request, Program $program, ProgramService $service)
    {
        abort_unless($service->program_id === $program->id, 404);

        $validated = $request->validate([
            'fa_icon' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service->update($validated);

        return back()->with('success', 'Service updated.');
    }

    public function destroy(Program $program, ProgramService $service)
    {
        abort_unless($service->program_id === $program->id, 404);
        $service->delete();
        return back()->with('success', 'Service deleted.');
    }
}