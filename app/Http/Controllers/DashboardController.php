<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Berita;
use App\Models\Promosi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {

        $beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();

        $events = Event::with('mentors')->where('tanggal_mulai', '>=', now())
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        foreach ($events as $event) {
            logger($event->mentors->count()); // Log jumlah mentor setiap event
        }


        $promosis = Promosi::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('dashboard', compact('events', 'beritas', 'promosis'));
    }
}
