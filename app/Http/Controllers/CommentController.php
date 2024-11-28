<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use id;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('communities.posts.show', [$post->community_id, $post->id])->with('success', 'Berhasi tambah komentar!');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);  // Assuming you have a policy to handle delete permissions

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
