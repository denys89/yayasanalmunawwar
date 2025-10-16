<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramDonation;
use Illuminate\Http\Request;

class ProgramDonationController extends Controller
{
    public function index(Program $program)
    {
        $donations = $program->donations()->latest()->get();
        return view('cms.programs.donations.index', compact('program', 'donations'));
    }

    public function store(Request $request, Program $program)
    {
        $validated = $request->validate([
            'fa_icon' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $program->donations()->create($validated);

        return back()->with('success', 'Donation added.');
    }

    public function update(Request $request, Program $program, ProgramDonation $donation)
    {
        abort_unless($donation->program_id === $program->id, 404);

        $validated = $request->validate([
            'fa_icon' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $donation->update($validated);

        return back()->with('success', 'Donation updated.');
    }

    public function destroy(Program $program, ProgramDonation $donation)
    {
        abort_unless($donation->program_id === $program->id, 404);
        $donation->delete();
        return back()->with('success', 'Donation deleted.');
    }
}