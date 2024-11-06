<?php

namespace App\Http\Controllers;

use id;
use App\Models\Event;
use App\Models\Mentor;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exports\ParticipantsExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $events = Event::with('mentor')->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $mentor = Mentor::all();
        return view('events.create', compact( 'mentor'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {

            $data = $request->validated();
            $data['image'] = $request->file('image')->store('events', 'public');
            $data['user_id'] = auth()->id();
    
            $event = Event::create($data);
            return to_route('events.index');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    // $event = Event::with('participants')->findOrFail($id);
    // return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $mentor = Mentor::all();
        return view('events.edit', compact('mentor', 'event'));
    }

    public function joinEvent(Event $event)
    {
        $user = Auth::user();

        // Cek apakah user sudah bergabung
        if ($event->participants()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('message', 'You have already joined this event.');
        }

        // Tambah user ke event
        $event->participants()->attach($user->id);

        return redirect()->back()->with('message', 'You have successfully joined the event.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }

        $event->update($data);
        return to_route('events.index');
    }
    public function showParticipants(Event $event)
{
    // Ambil daftar peserta dari event tertentu
    $participants = $event->participants()->select('users.id', 'users.name', 'users.email','users.no_telp')->get();
    $countParticipants = $participants->count(); // Hitung jumlah peserta
    return view('events.participants', compact('event', 'participants', 'countParticipants'));
}

    public function exportParticipants(Event $event)
    {
        return Excel::download(new ParticipantsExport($event), 'peserta-' . $event->nama_event . '.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete($event->image);
        $event->delete();
        return to_route('events.index');
    }
}
