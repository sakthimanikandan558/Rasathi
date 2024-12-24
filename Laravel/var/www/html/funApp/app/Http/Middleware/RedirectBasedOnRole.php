<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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


        // if (Auth::check()) {
        //     $role = Auth::user()->role_id;
        //     $currentRoute = $request->route()->getName();

        //     // Avoid redirecting if already on the correct route
        //     switch ($role) {
        //         case 1:
        //             if ($currentRoute !== 'admin') {
        //                 return redirect()->route('admin');
        //             }
        //             break;
        //         case 2:
        //             if ($currentRoute !== 'user') {
        //                 return redirect()->route('user');
        //             }
        //             break;
        //         case 3:
        //             if ($currentRoute !== 'content_writer') {
        //                 return redirect()->route('content_writer');
        //             }
        //             break;
        //         default:
        //             Auth::logout();
        //             return redirect('/')->withErrors('Unauthorized access');
        //     }
        // }

        return $next($request);
    }
}
