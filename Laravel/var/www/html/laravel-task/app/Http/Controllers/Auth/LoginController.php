<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function authenticate(Request $request){

        $request->validate(

            [
                'email' => 'required',
                'password' => 'required'

            ]
        );

        $email = $request->input('email');
        $password = $request->input('password');


        if (Auth::attempt(['email'=>$email,'password'=>$password])) {
            
            $user = User::where('email',$email)->first();
            Auth::login($user);

            if($user->isAdmin){
                return redirect('/admin');
            }
            else{
                return redirect('/home');
            }

            // return redirect('/home');

        }else{

            return back()->withErrors(['invalid Login']);
        }

    }

    // public function admin()
    // {
    //     return view('/admin');
    // }

    // public function user()
    // {
    //     return view('/home');
    // }


    public function logout(){

        Auth::logout();
        return redirect('/login');
    }
}
