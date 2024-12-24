<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $posts = Post::with('user')->paginate(6); // Eager load user relationship
        if ($request->ajax()) {
            return view('partials.request_table', compact('posts'))->render();
        }
        
        return view('content.admin', compact('posts'));
    }

    public function approve(Post $post)
    {
        $post->is_approved = true;
        $post->save();

        return redirect()->back()->with('success', 'Post approved successfully.');
    }

    public function reject(Post $post)
    {
        $post->is_approved = false;
        $post->save();

        return redirect()->back()->with('success', 'Post rejected successfully.');
    }
}
