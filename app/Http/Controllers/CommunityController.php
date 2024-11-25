<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommunityController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request, $community_id = null)
    {
        $communities = Community::all();
        $selectedCommunity = $community_id ? Community::find($community_id) : null;

        $query = $selectedCommunity ? $selectedCommunity->posts() : null;

        if ($query && $request->has('search')) {
            $searchTerm = $request->input('search');
            $query = $query->where('content', 'LIKE', '%' . $searchTerm . '%');
        }

        $posts = $query ? $query->latest()->paginate(6) : null;

        return view('communities.index', compact('communities', 'selectedCommunity', 'posts'));
    }


    public function create()
    {
        $this->authorize('create', Community::class);
        return view('communities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jml_anggota' => 'nullable|integer'
        ]);

        $data = $request->only('name', 'description', 'jml_anggota'); // Tambahkan 'jml_anggota'

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        Community::create($data);

        return redirect()->route('communities.index')->with('success', 'Community created successfully');
    }

    public function update(Request $request, Community $community)
{
    $this->authorize('update', $community);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jml_anggota' => 'nullable|integer'
        ]);

        $data = $request->only('name', 'description', 'jml_anggota'); // Tambahkan 'jml_anggota'

    if ($request->hasFile('thumbnail')) {
        if ($community->thumbnail) {
            Storage::disk('public')->delete($community->thumbnail);
        }
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $data['thumbnail'] = $thumbnailPath;
    }

    $community->update($data);

        return redirect()->route('communities.index')->with('success', 'Community updated successfully');
    }

    public function edit(Community $community)
    {
        // Check jika user memiliki akses
        $this->authorize('update', $community);

        return view('communities.edit', compact('community'));
    }


    public function destroy(Community $community)
    {
        $this->authorize('delete', $community);

        if ($community->thumbnail) {
            Storage::disk('public')->delete($community->thumbnail);
        }

        $community->delete();

        return redirect()->route('communities.index')->with('success', 'Community deleted successfully');
    }
}
