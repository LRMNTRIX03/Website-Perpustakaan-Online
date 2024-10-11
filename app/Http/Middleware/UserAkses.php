<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class UserAkses
{
   
public function handle(Request $request, Closure $next, $role): Response
{
   
    if (Auth::check()) {
        
        if (Auth::user()->role == $role) {
            return $next($request);
        }

       
        return response()->redirectTo('peringatan');
    }

    
    return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
}

}
