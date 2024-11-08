<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class UserController extends Controller
{
    public function showHistory()
    {
        $user = Auth::user(); // Mengambil user yang sedang login
        $events = $user->events()->get(); // Mengambil event yang diikuti oleh user melalui relasi
        return view('user.history', compact('events'));
    }
}
