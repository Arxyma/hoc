<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventShowController extends Controller
{
    public function __invoke($slug)
{
    $event = Event::where('slug', $slug)->firstOrFail();
    
    // Menghitung jumlah peserta yang bergabung dengan event
    $countParticipants = $event->participants()->count();
    $kuota = $event->kuota;
    $mentors = $event->mentors;

    // Menambahkan logika rekomendasi event
        $rekomendasiEvent = Event::where('tanggal_mulai', '>', now())
        ->where('id', '!=', $event->id) // Jangan tampilkan event yang sedang dibuka
        ->inRandomOrder()
        ->limit(3) // Batasi jumlah rekomendasi
        ->get();

    return view('eventsShow', compact('event', 'countParticipants', 'kuota', 'mentors', 'rekomendasiEvent'));
}

}
