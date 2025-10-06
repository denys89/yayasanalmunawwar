<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('organizer', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhereDate('datetime', $search);
            });
        }

        $events = $query->latest('datetime')->paginate(10)->withQueryString();

        return view('cms.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'datetime' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('events', 'public');
            $validated['banner_image'] = $path;
        }

        // Basic sanitization: allow safe HTML via strip_tags with allowed tags
        $validated['description'] = \Illuminate\Support\Str::of($validated['description'])
            ->replace('<script', '&lt;script')
            ->replace('</script>', '&lt;/script&gt;')
            ->toString();

        Event::create($validated);

        return redirect()->route('cms.events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('cms.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('cms.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'datetime' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('banner_image')) {
            // delete old if exists
            if ($event->banner_image && Storage::disk('public')->exists($event->banner_image)) {
                Storage::disk('public')->delete($event->banner_image);
            }
            $path = $request->file('banner_image')->store('events', 'public');
            $validated['banner_image'] = $path;
        }

        $validated['description'] = \Illuminate\Support\Str::of($validated['description'])
            ->replace('<script', '&lt;script')
            ->replace('</script>', '&lt;/script&gt;')
            ->toString();

        $event->update($validated);

        return redirect()->route('cms.events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Delete banner image
        if ($event->banner_image && Storage::disk('public')->exists($event->banner_image)) {
            Storage::disk('public')->delete($event->banner_image);
        }

        $event->delete();

        return redirect()->route('cms.events.index')->with('success', 'Event deleted successfully.');
    }
}