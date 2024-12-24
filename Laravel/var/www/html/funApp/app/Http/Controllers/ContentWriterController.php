<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ContentWriterController extends Controller
{
    public function content_writer()
    {
        // $user = auth()->user(); // Get the authenticated user
        // $posts = Post::where('user_id', $user->id)->get(); // Fetch posts associated with the user

        // return view('content.content_writer', compact('posts'));

        $user = User::with('posts')->findOrFail(auth()->id());
        $posts = $user->posts;

        return view('content.content_writer', compact('posts', 'user'));
    }

    /**
     * Store a newly created post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = auth()->user()->id; // Assign logged in user's ID
        $post->created_by = auth()->user()->id; // Assign logged in user's ID as creator
        $post->updated_by = auth()->user()->id; // Assign logged in user's ID as updater
        $post->is_approved = null; // Set is_approved to null initially

        $post->save();

        return redirect()->back()->with('Post created successfully.');
    }

    /**
     * Update the specified post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully.');
    }
}
