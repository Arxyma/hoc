<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('eventsShow', compact('event'));
    }
}
