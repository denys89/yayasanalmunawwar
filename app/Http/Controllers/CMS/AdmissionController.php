<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admissions = Admission::latest()->paginate(10);
        return view('cms.admissions.index', compact('admissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.admissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'level' => 'required|in:elementary,middle,high',
            'document_url' => 'nullable|url',
            'status' => 'required|in:pending,verified,rejected',
        ]);

        Admission::create($validated);

        return redirect()->route('cms.admissions.index')
            ->with('success', 'Admission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admission $admission)
    {
        return view('cms.admissions.show', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admission $admission)
    {
        return view('cms.admissions.edit', compact('admission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'level' => 'required|in:elementary,middle,high',
            'document_url' => 'nullable|url',
            'status' => 'required|in:pending,verified,rejected',
        ]);

        $admission->update($validated);

        return redirect()->route('cms.admissions.index')
            ->with('success', 'Admission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admission $admission)
    {
        $admission->delete();

        return redirect()->route('cms.admissions.index')
            ->with('success', 'Admission deleted successfully.');
    }

    /**
     * Verify an admission
     */
    public function verify(Admission $admission)
    {
        $admission->update(['status' => 'verified']);

        return redirect()->route('cms.admissions.index')
            ->with('success', 'Admission verified successfully.');
    }

    /**
     * Reject an admission
     */
    public function reject(Admission $admission)
    {
        $admission->update(['status' => 'rejected']);

        return redirect()->route('cms.admissions.index')
            ->with('success', 'Admission rejected successfully.');
    }
}
