<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
        // ]);

        $user = User::find(1); 

        $user->addMedia($request->file('file'))->toMediaCollection('images');

        return back()->with('success', 'Media uploaded successfully.');
    }

    public function show()
    {
        $user = User::find(1); 

        $mediaItems = $user->getMedia('images');

        return view('media.show', compact('mediaItems'));
    }
}
