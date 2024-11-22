<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $events = Event::with('mentors')->orderBy('created_at', 'desc')->paginate(12);
        return view('eventIndex', compact('events'));
    }
}