<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user=Auth::user();
            if ($user->isAdmin) {
                if($request->is('home')){
                    return redirect('/admin');
                }
  
            } 
            else {
                if($request->is('admin')){  
                    return redirect('/home');
                }
            }
        

        // If not authenticated, redirect to login page
        // return redirect('/login');
        // return redirect()->route('login')->withErrors(['login_error' => 'You must be logged in to access this page.']);
        return $next($request);

    
    }
}
