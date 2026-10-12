<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->user_type == 4) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect(url('login'))->with('error', 'Akses khusus akun orang tua siswa.');
            }
        }

        Auth::logout();
        return redirect(url('login'));
    }
}
