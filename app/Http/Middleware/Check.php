<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Check
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            
            return $next($request); 
        }
            
            // 2. كارت الممر: السطر ده معناه "عدّيه للخطوة اللي بعدها"
            return response()->view('auth.login', ['title' => 'Login']);
    }
}