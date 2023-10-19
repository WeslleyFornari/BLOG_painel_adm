<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status != 'ativo') {
            Auth::logout();

            return redirect()->route('login')->with('error', 'Sua conta não está ativa.');
        }

        return $next($request);
    }
}
