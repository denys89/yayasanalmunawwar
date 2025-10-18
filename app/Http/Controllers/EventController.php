<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index(Request $request)
    {
        $events = Event::query()
            ->where('status', 'published')
            ->latest('datetime')
            ->paginate(9)
            ->withQueryString();

        return view('acara', compact('events'));
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        if ($event->status !== 'published') {
            abort(404);
        }

        $upcomingEvents = Event::query()
            ->where('status', 'published')
            ->where('datetime', '>', now())
            ->orderBy('datetime')
            ->take(5)
            ->get();

        return view('acara-detail', [
            'event' => $event,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}