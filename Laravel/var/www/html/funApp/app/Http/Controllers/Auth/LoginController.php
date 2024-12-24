<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {


            // Authentication passed; redirect to the appropriate dashboard
            return $this->redirectToDashboard();
        }

        // Authentication failed; redirect back with error message
        return redirect()->back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }


    protected function redirectToDashboard()
    {
        $role = Auth::user()->role_id;

        switch ($role) {
            case 1:
                return redirect()->route('admin');
            case 2:
                return redirect()->route('user');
            case 3:
                return redirect()->route('content_writer');
            default:
                Auth::logout();
                return redirect('/')->withErrors('Unauthorized access');
        }
    }
}


