<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'required|string|size:10|unique:users',
            'role' => 'required',
            'password' => 'required|string|min:3|confirmed', // password confirmation field
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new user
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->role_id = $request->input('role');
        $user->password = Hash::make($request->input('password')); // Hash the password

        // Save the user to the database
        $user->save();

        // Redirect or return a response
        return redirect('login')->with('success', 'Registration successful. Please log in.');
    }
}
