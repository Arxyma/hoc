<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    // Menampilkan semua postingan dalam komunitas
    public function index(Community $community)
    {
        $posts = $community->posts()->latest()->paginate(10);
        return view('communities.posts.index', compact('community', 'posts'));
    }

    public function create(Community $community)
    {
        return view('communities.posts.create', compact('community')); // Update ke namespaces yang benar
    }

    // Menyimpan postingan baru
    public function store(Request $request, Community $community)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->community_id = $community->id; // Pastikan ini menggunakan ID komunitas yang benar
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('post_images', 'public');
        }

        $post->save();

        return redirect()->route('communities.index', $community)
            ->with('success', 'Postingan berhasil dibuat.');
    }


    // Menampilkan form untuk mengedit postingan
    public function edit(Community $community, Post $post)
    {
        $this->authorize('update', $post);
        return view('communities.posts.edit', compact('community', 'post')); // Update ke namespaces yang benar
    }
    // Mengupdate postingan
    public function update(Request $request, Community $community, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('post_images', 'public');
        }

        $post->save();

        return redirect()->route('communities.index', $community)
            ->with('success', 'Postingan berhasil diupdate.');
    }

    // Menghapus postingan
    public function destroy(Community $community, Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('communities.index', $community)
            ->with('success', 'Postingan berhasil dihapus.');
    }
}
