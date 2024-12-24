<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[A-Za-z]+(?:[ .][A-Za-z]+)*$/|max:255',
            'age' => 'required|integer|min:18',
            'email' => 'required|email|regex:/^[^@]+@[^@]+\.[^@]+$/|max:255',
            'course' => 'required',
            'college' => 'required',
            'department' => 'required',
            'mobile' => 'required|digits:10',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Handle the validated data (e.g., save to database)

        return redirect('/form')->with('success', 'Form submitted successfully!');
    }
}
