<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Mentor;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateMentorRequest;
use App\Http\Requests\UpdateMentorRequest;


class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $mentors = Mentor::all();
    //     return view('mentors.index', compact('mentors'));
    // }
    public function index(Request $request)
    {
        $sort = $request->get('sort');

        if ($sort == 'name_asc') {
            $mentors = Mentor::orderBy('name', 'asc')->get();
        } elseif ($sort == 'name_desc') {
            $mentors = Mentor::orderBy('name', 'desc')->get();
        } elseif ($sort == 'updated_at_asc') {
            $mentors = Mentor::orderBy('updated_at', 'asc')->get();
        } elseif ($sort == 'updated_at_desc') {
            $mentors = Mentor::orderBy('updated_at', 'desc')->get();
        } else {
            $mentors = Mentor::paginate(12); // Default, ambil semua
        }

        return view('mentors.index', compact('mentors'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mentors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMentorRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {

            $data = $request->validated();
            $data['image'] = $request->file('image')->store('mentors', 'public');


            $mentor = Mentor::create($data);
            return redirect()->route('mentors.index')->with('success', 'Berhasil tambah mentor!');

        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function showEvents($mentorId)
    {
        // Ambil mentor berdasarkan ID
        $mentor = Mentor::findOrFail($mentorId);

        // Ambil event yang diikuti oleh mentor
        $events = $mentor->events;
        $events = $mentor->events()->paginate(12);


        // Tampilkan view yang menampilkan event untuk mentor
        return view('mentors.events', compact('mentor', 'events'));
    }
    
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentor $mentor): View
    {
        return view('mentors.edit', compact('mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMentorRequest $request, Mentor $mentor): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($mentor->image);
            $data['image'] = $request->file('image')->store('mentors', 'public');
        }

        $mentor->update($data);
        return redirect()->route('mentors.index')->with('success', 'Berhasil update mentor!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor): RedirectResponse
    {
        Storage::delete($mentor->image);
        $mentor->delete();
        return to_route('mentors.index');
    }
}
