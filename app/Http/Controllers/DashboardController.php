<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke()
    // {
    //     $events = Event::with('mentor')->where('tanggal', '>=', today())->orderBy('created_at', 'desc')->get();

    //     return view('dashboard', compact('events'));
    // }
    public function __invoke()
{
    $events = Event::with('mentor')->where('tanggal', '>=', today())->orderBy('created_at', 'desc')->get();
    return view('dashboard', compact('events'));
}

    
}
