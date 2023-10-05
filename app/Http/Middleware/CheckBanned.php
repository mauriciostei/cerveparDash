<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (!auth()->user()->active)){
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status', 'Usuario inactivo en el sistema');
        }

        return $next($request);
    }
}
