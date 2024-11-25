<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Mentor;
use App\Models\Event;
use App\Models\Promosi;
use App\Models\User;

class PimpinanController extends Controller
{
    public function dashboard()
    {
        // Ambil jumlah user level 1 dan level 2
        $userLevel1Count = User::where('role_name', 'level1')->count();
        $userLevel2Count = User::where('role_name', 'level2')->count();

        // Ambil jumlah komunitas
        $communityCount = Community::count();

        // Ambil jumlah promosi
        $promotionCount = Promosi::count();

        // Ambil jumlah mentor
        $mentorCount = Mentor::count();

        // Ambil jumlah event
        $eventCount = Event::count();

        return view('pimpinan.dashboard', compact(
            'userLevel1Count',
            'userLevel2Count',
            'communityCount',
            'promotionCount',
            'mentorCount',
            'eventCount'
        ));
    }
}
