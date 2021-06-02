<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        return view('comments', ['commentsPost' => $post, 'comments' => Comment::where('post_id', $post->id)->get()]);
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'bail|required|min:10|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $request['content'],
        ]);

        return redirect("/$post->id/comments");
    }
}
