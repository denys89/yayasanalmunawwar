<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\AdmissionWave;
use App\Http\Requests\DiscountRequest;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Discount::with(['admissionWave']);

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter by admission wave
        if ($request->filled('admission_wave_id')) {
            $query->where('admission_wave_id', $request->admission_wave_id);
        }

        $discounts = $query->latest()->paginate(10);
        $admissionWaves = AdmissionWave::all();

        return view('cms.discounts.index', compact('discounts', 'admissionWaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admissionWaves = AdmissionWave::all();
        return view('cms.discounts.create', compact('admissionWaves'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        $validated = $request->validated();

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        Discount::create($validated);

        return redirect()->route('cms.discounts.index')
            ->with('success', 'Discount created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        $discount->load(['admissionWave', 'creator', 'updater']);
        return view('cms.discounts.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        $admissionWaves = AdmissionWave::all();
        return view('cms.discounts.edit', compact('discount', 'admissionWaves'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountRequest $request, Discount $discount)
    {
        $validated = $request->validated();

        $validated['updated_by'] = Auth::id();

        $discount->update($validated);

        return redirect()->route('cms.discounts.index')
            ->with('success', 'Discount updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('cms.discounts.index')
            ->with('success', 'Discount deleted successfully.');
    }
}
