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
        $posts = $community->posts()->latest()->paginate(5);
        return view('communities.posts.index', compact('community', 'posts'));
    }

    public function show(Community $community, Post $post)
    {
        if ($post->community_id !== $community->id) {
            abort(404);
        }

        // Ambil komentar dengan pagination
        $comments = $post->comments()->with('user')->latest()->paginate(10);

        return view('communities.posts.show', [
            'community' => $community,
            'post' => $post,
            'comments' => $comments, // Pass paginated comments
        ]);
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


    public function edit($communityId, $postId)
    {
        $community = Community::findOrFail($communityId);
        $post = Post::findOrFail($postId);

        // Pastikan hanya pemilik atau admin yang bisa mengakses
        $this->authorize('update', $post);

        return view('communities.posts.edit', compact('community', 'post'));
    }

    // Mengupdate postingan
    public function update(Request $request, $communityId, $postId)
    {
        $community = Community::findOrFail($communityId);
        $post = Post::findOrFail($postId);

        // Pastikan hanya pemilik atau admin yang bisa mengupdate
        $this->authorize('update', $post);

        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('communities.index', $communityId)->with('success', 'Post updated successfully!');
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
