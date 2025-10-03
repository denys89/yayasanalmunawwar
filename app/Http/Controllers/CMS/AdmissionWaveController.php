<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\AdmissionWave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionWaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admissionWaves = AdmissionWave::with(['creator', 'updater'])
            ->latest()
            ->paginate(10);
        
        return view('cms.admission-waves.index', compact('admissionWaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.admission-waves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:kb,tk,sd',
            'registration_fee' => 'required|integer|min:0',
            'final_payment_fee' => 'required|integer|min:0',
            'start_date' => 'required|integer',
            'end_date' => 'required|integer|gt:start_date',
            'is_active' => 'nullable|boolean',
            'capacity' => 'required|integer|min:0',
        ], [
            'end_date.gt' => 'End date must be after start date.',
        ]);

        // Set is_active to false if not provided
        $validated['is_active'] = $request->has('is_active') ? (bool) $request->is_active : false;

        // Check for overlapping date ranges at the same level
        $overlapping = AdmissionWave::where('level', $validated['level'])
            ->where(function ($query) use ($validated) {
                $query->where(function ($q) use ($validated) {
                    // New range starts within existing range
                    $q->where('start_date', '<=', $validated['start_date'])
                      ->where('end_date', '>=', $validated['start_date']);
                })->orWhere(function ($q) use ($validated) {
                    // New range ends within existing range
                    $q->where('start_date', '<=', $validated['end_date'])
                      ->where('end_date', '>=', $validated['end_date']);
                })->orWhere(function ($q) use ($validated) {
                    // New range completely contains existing range
                    $q->where('start_date', '>=', $validated['start_date'])
                      ->where('end_date', '<=', $validated['end_date']);
                });
            })
            ->exists();

        if ($overlapping) {
            return back()->withErrors([
                'date_range' => 'The selected date range overlaps with an existing admission wave for the same level.'
            ])->withInput();
        }

        // Auto-fill created_by
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        AdmissionWave::create($validated);

        return redirect()->route('cms.admission-waves.index')
            ->with('success', 'Admission Wave created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdmissionWave $admissionWave)
    {
        $admissionWave->load(['creator', 'updater']);
        return view('cms.admission-waves.show', compact('admissionWave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdmissionWave $admissionWave)
    {
        return view('cms.admission-waves.edit', compact('admissionWave'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdmissionWave $admissionWave)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:kb,tk,sd',
            'registration_fee' => 'required|integer|min:0',
            'final_payment_fee' => 'required|integer|min:0',
            'start_date' => 'required|integer',
            'end_date' => 'required|integer|gt:start_date',
            'is_active' => 'nullable|boolean',
            'capacity' => 'required|integer|min:0',
        ], [
            'end_date.gt' => 'End date must be after start date.',
        ]);

        // Set is_active to false if not provided
        $validated['is_active'] = $request->has('is_active') ? (bool) $request->is_active : false;

        // Check for overlapping date ranges at the same level (excluding current record)
        $overlapping = AdmissionWave::where('level', $validated['level'])
            ->where('id', '!=', $admissionWave->id)
            ->where(function ($query) use ($validated) {
                $query->where(function ($q) use ($validated) {
                    // New range starts within existing range
                    $q->where('start_date', '<=', $validated['start_date'])
                      ->where('end_date', '>=', $validated['start_date']);
                })->orWhere(function ($q) use ($validated) {
                    // New range ends within existing range
                    $q->where('start_date', '<=', $validated['end_date'])
                      ->where('end_date', '>=', $validated['end_date']);
                })->orWhere(function ($q) use ($validated) {
                    // New range completely contains existing range
                    $q->where('start_date', '>=', $validated['start_date'])
                      ->where('end_date', '<=', $validated['end_date']);
                });
            })
            ->exists();

        if ($overlapping) {
            return back()->withErrors([
                'date_range' => 'The selected date range overlaps with an existing admission wave for the same level.'
            ])->withInput();
        }

        // Auto-fill updated_by
        $validated['updated_by'] = Auth::id();

        $admissionWave->update($validated);

        return redirect()->route('cms.admission-waves.index')
            ->with('success', 'Admission Wave updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdmissionWave $admissionWave)
    {
        $admissionWave->delete();

        return redirect()->route('cms.admission-waves.index')
            ->with('success', 'Admission Wave deleted successfully.');
    }

    /**
     * Check for overlapping date ranges via AJAX.
     */
    public function checkOverlap(Request $request)
    {
        $request->validate([
            'level' => 'required|in:kb,tk,sd',
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'id' => 'sometimes|integer', // For edit form
        ]);

        $query = AdmissionWave::where('level', $request->level)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    // New range starts within existing range
                    $q->where('start_date', '<=', $request->start_date)
                      ->where('end_date', '>=', $request->start_date);
                })->orWhere(function ($q) use ($request) {
                    // New range ends within existing range
                    $q->where('start_date', '<=', $request->end_date)
                      ->where('end_date', '>=', $request->end_date);
                })->orWhere(function ($q) use ($request) {
                    // New range completely contains existing range
                    $q->where('start_date', '>=', $request->start_date)
                      ->where('end_date', '<=', $request->end_date);
                });
            });

        // Exclude current record if editing
        if ($request->has('id')) {
            $query->where('id', '!=', $request->id);
        }

        $overlapping = $query->exists();

        return response()->json(['overlapping' => $overlapping]);
    }

    /**
     * API endpoint to get admission waves by level
     */
    public function getByLevel(Request $request)
    {
        $request->validate([
            'level' => 'required|in:kb,tk,sd'
        ]);

        $admissionWaves = AdmissionWave::where('level', $request->level)
            ->where('is_active', true)
            ->select('id', 'name', 'level', 'registration_fee', 'final_payment_fee', 'start_date', 'end_date')
            ->orderBy('start_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $admissionWaves
        ]);
    }
}