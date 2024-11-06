<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommunityController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request, $community_id = null)
    {
        $communities = Community::all(); // Semua komunitas di sidebar
        $selectedCommunity = $community_id ? Community::find($community_id) : null;

        // Ambil postingan hanya jika ada komunitas yang dipilih
        $posts = $selectedCommunity ? $selectedCommunity->posts()->paginate(10) : null;

        return view('communities.index', compact('communities', 'selectedCommunity', 'posts'));
    }


    public function show(Community $community)
    {
        $posts = $community->posts()->paginate(10);
        return view('communities.show', compact('community', 'posts'));
    }

    public function create()
    {
        $this->authorize('create', Community::class);
        return view('communities.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Community::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Community::create($validated);

        return redirect()->route('communities.index')->with('success', 'Komunitas berhasil dibuat.');
    }

    public function update(Request $request, Community $community)
    {
        $this->authorize('update', $community);
        // Logika untuk memperbarui komunitas
    }

    public function destroy(Community $community)
    {
        $this->authorize('delete', $community);
        // Logika untuk menghapus komunitas
    }
}
