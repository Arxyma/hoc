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
        $mentors = Mentor::all(); // Default, ambil semua
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
            return to_route('mentors.index');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentor $mentor)
    {
        // Ambil event yang terkait dengan mentor ini
        $events = $mentor->events;
        $events = $mentor->events()->paginate(12);
    
        // Kembalikan tampilan dengan data mentor dan event yang terkait
        return view('mentors.show', compact('mentor', 'events'));
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
        return to_route('mentors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor): RedirectResponse
    {
        $mentor->delete();
        return to_route('mentors.index');
    }
}
