<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Berita;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $events = Event::with('mentor')->where('tanggal', '>=', today())->orderBy('created_at', 'desc')->get();

        $beritas = Berita::orderBy('created_at', 'desc')->get();
        $beritas = Berita::latest()->paginate(3);
        return view('dashboard', compact('events', 'beritas'));
    }
}
