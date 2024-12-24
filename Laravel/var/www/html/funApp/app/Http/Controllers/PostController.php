<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::where('is_approved', true)->with('user')->get();

        return view('content.user', compact('posts'));
    }

    public function show(Post $post)
    {
        $user = User::find($post->user_id);
        $likes = $post->likes()->where('is_like', true)->count();
        $comments = $post->comments()->get();
        return view('posts.show', compact('post', 'user', 'likes', 'comments'));
    }

    public function Comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required',
        ]);


        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back();
    }

    public function Like(Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();
        if ($like) {
            $like->delete();
        } else {
            $like = new Like;
            $like->user_id = Auth::id();
            $like->post_id = $post->id;
            $like->is_like = true;
            $like->save();
        }
        return redirect()->back();
    }


    public function deleteComment(Post $post, Comment $comment)
    {
        if ($comment->user_id == Auth::id()) {
            $comment->delete();
        }

        return back();
    }

   
    public function updateComment(Request $request, Post $post, Comment $comment)
    {
        if ($comment->user_id == Auth::id()) {
            $comment->update([
                'comment' => $request->input('content'),
            ]);
        }

        return back();
    }
}

