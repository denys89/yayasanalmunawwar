<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'curriculum' => 'nullable|string',
            'brochure_url' => 'nullable|url',
            'brochure_file' => 'nullable|file|mimes:pdf,doc,docx,odt|max:10240',
            'banner_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'photo_description' => 'nullable|string|max:255',
            'program_type' => 'nullable|in:education,social,religious',
            'phone' => ['nullable','regex:/^[0-9\s+\-()]+$/','max:50'],
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle brochure file upload (takes precedence over URL if both provided)
        if ($request->hasFile('brochure_file')) {
            $path = $request->file('brochure_file')->store('programs/brochures', 'public');
            $validated['brochure_url'] = $path;
        }

        // Handle banner upload
        if ($request->hasFile('banner_file')) {
            $bannerPath = $request->file('banner_file')->store('programs/banners', 'public');
            $validated['banner_url'] = $bannerPath;
        }

        // Handle photo upload
        if ($request->hasFile('photo_file')) {
            $photoPath = $request->file('photo_file')->store('programs/photos', 'public');
            $validated['photo_url'] = $photoPath;
        }

        Program::create($validated);

        return redirect()->route('cms.programs.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $facilities = $program->facilities()->latest()->get();
        $educations = $program->educations()->latest()->get();
        $services = $program->services()->latest()->get();
        $donations = $program->donations()->latest()->get();
        $activities = $program->activities()->latest()->get();
        return view('cms.programs.show', compact('program', 'facilities', 'educations', 'services', 'donations', 'activities'));
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
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'curriculum' => 'nullable|string',
            'brochure_url' => 'nullable|url',
            'brochure_file' => 'nullable|file|mimes:pdf,doc,docx,odt|max:10240',
            'banner_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'photo_description' => 'nullable|string|max:255',
            'program_type' => 'nullable|in:education,social,religious',
            'phone' => ['nullable','regex:/^[0-9\s+\-()]+$/','max:50'],
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle brochure file upload (takes precedence over URL if both provided)
        if ($request->hasFile('brochure_file')) {
            // Delete previous stored file if it was a local storage path
            if ($program->brochure_url && !str_starts_with($program->brochure_url, 'http')) {
                Storage::disk('public')->delete($program->brochure_url);
            }
            $path = $request->file('brochure_file')->store('programs/brochures', 'public');
            $validated['brochure_url'] = $path;
        }

        // Handle banner upload
        if ($request->hasFile('banner_file')) {
            if ($program->banner_url && !str_starts_with($program->banner_url, 'http')) {
                Storage::disk('public')->delete($program->banner_url);
            }
            $bannerPath = $request->file('banner_file')->store('programs/banners', 'public');
            $validated['banner_url'] = $bannerPath;
        }

        // Handle photo upload
        if ($request->hasFile('photo_file')) {
            if ($program->photo_url && !str_starts_with($program->photo_url, 'http')) {
                Storage::disk('public')->delete($program->photo_url);
            }
            $photoPath = $request->file('photo_file')->store('programs/photos', 'public');
            $validated['photo_url'] = $photoPath;
        }

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
