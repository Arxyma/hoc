<?php

namespace App\Http\Controllers;

use id;
use App\Models\Tag;
use App\Models\Event;
use App\Models\Mentor;
use Illuminate\View\View;
use Illuminate\Support\Str;
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
    public function index(Request $request): View
    {
        $sortOption = $request->get('sort');
        $query = Event::query()->with('mentors');


        switch ($sortOption) {
            case 'nama_event_asc':
                $query->orderBy('nama_event', 'asc');
                break;
            case 'nama_event_desc':
                $query->orderBy('nama_event', 'desc');
                break;
            case 'tanggal_mulai_asc':
                $query->orderBy('tanggal_mulai', 'asc');
                break;
            case 'tanggal_mulai_desc':
                $query->orderBy('tanggal_mulai', 'desc');
                break;
            default:
                // Default sorting, adjust if needed
                $query->orderBy('created_at', 'desc');
        }

        $events = $query->get();

        return view('events.index', compact('events'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $mentors = Mentor::all();
        $tags = Tag::all();
        return view('events.create', compact('mentors', 'tags'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(CreateEventRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Menambahkan slug
        $data['slug'] = Str::slug($request->input('nama_event'));

        // Menambahkan user_id
        $data['user_id'] = auth()->id();

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        // Simpan event ke database
        $event = Event::create($data);

        // Relasi many-to-many untuk mentor dan tag
        $event->mentors()->sync($request->input('mentor_ids', []));
        $event->tags()->sync($request->input('tags', []));

        return to_route('events.index')->with('success', 'Event berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('eventShow', compact('event'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $mentors = Mentor::all();
        return view('events.edit', compact('mentor', 'event'));
    }

    public function joinEvent(Event $event)
    {
        $user = Auth::user();

        // Cek apakah kuota sudah penuh
        if ($event->participants()->count() >= $event->kuota) {
            return redirect()->back()->with('message', 'Kuota event sudah penuh. Anda tidak bisa mendaftar lagi.');
        }

        // Cek apakah user sudah bergabung
        if ($event->participants()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('message', 'Anda sudah terdaftar dalam event ini.');
        }
        // Periksa apakah profil lengkap
        if (empty($user->name) || empty($user->email) || empty($user->no_telp) || empty($user->alamat) || empty($user->usia)) {
            // Simpan status dan pesan di session untuk alert
            session()->flash('incomplete_profile', true);
            session()->flash('message', 'Anda harus melengkapi profil terlebih dahulu untuk bergabung dalam event ini.');

            return redirect()->back();
        }
        // Tambahkan user ke event dengan status pending
        $event->participants()->attach($user->id, ['is_approved' => false]);

        return redirect()->back()->with('message', 'Anda berhasil bergabung dalam event ini.');
    }



    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $data['slug'] = Str::slug($data['nama_event']);
        $event->update($data);

        // Sync mentors
        $event->mentors()->sync($request->input('mentor_ids', []));

        return redirect()->route('events.index');
    }

    public function showParticipants(Event $event, Request $request)
    {
        $sortOption = $request->get('sort');
        $query = $event->participants()->select('users.id', 'users.name', 'users.email', 'users.no_telp', 'users.usia', 'users.alamat')->withPivot('created_at');

        switch ($sortOption) {
            case 'name_asc':
                $query->orderBy('users.name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('users.name', 'desc');
                break;
            case 'created_at_asc':
                $query->orderBy('event_user.created_at', 'asc');
                break;
            case 'created_at_desc':
                $query->orderBy('event_user.created_at', 'desc');
                break;
            default:
                $query->orderBy('event_user.created_at', 'desc');
        }

        $participants = $query->get();
        $countParticipants = $participants->count();
        $kuota = $event->kuota;

        return view('events.participants', compact('event', 'participants', 'countParticipants', 'kuota'));
    }

    public function showPendingParticipants(Event $event)
    {
        $pendingParticipants = $event->participants()->wherePivot('is_approved', false)->get();

        return view('events.pending-participants', [
            'event' => $event,
            'pendingParticipants' => $pendingParticipants
        ]);
    }

    public function approveParticipant(Event $event, $userId)
    {
        $event->participants()->updateExistingPivot($userId, ['is_approved' => true]);

        return redirect()->back()->with('message', 'Pendaftaran peserta berhasil disetujui.');
    }

    public function rejectParticipant(Event $event, $userId)
    {
        $event->participants()->detach($userId);

        return redirect()->back()->with('message', 'Pendaftaran peserta telah ditolak.');
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
