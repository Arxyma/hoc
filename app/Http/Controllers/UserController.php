<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class UserController extends Controller
{
    public function showHistory()
    {
        $user = Auth::user();

        // Hanya tampilkan event yang sudah disetujui
        $events = $user->events()->wherePivot('is_approved', true)->get();

        return view('user.history', compact('events'));
    }
}
