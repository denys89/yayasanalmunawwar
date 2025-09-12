<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::orderBy('order')->paginate(10);
        return view('cms.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Set default order if not provided
        if (!isset($validated['order'])) {
            $validated['order'] = Faq::max('order') + 1;
        }

        Faq::create($validated);

        return redirect()->route('cms.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return view('cms.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('cms.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $faq->update($validated);

        return redirect()->route('cms.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('cms.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}
