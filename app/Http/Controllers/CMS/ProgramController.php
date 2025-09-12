<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('cms.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'curriculum' => 'nullable|string',
            'brochure_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Program::create($validated);

        return redirect()->route('cms.programs.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('cms.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('cms.programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'curriculum' => 'nullable|string',
            'brochure_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $program->update($validated);

        return redirect()->route('cms.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('cms.programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
