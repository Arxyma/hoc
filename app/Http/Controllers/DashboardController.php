<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $events = Event::with('mentor')
        ->where('tanggal_mulai', '>=', now())
        ->orderBy('created_at', 'desc')
        ->take(6)  // Batasi hanya 6 event yang ditampilkan
        ->get();

    return view('dashboard', compact('events'));
    }
}
