<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$roles): Response
    {
      if(!Auth::check()){
        return redirect()->route("login");
      }
        $user = Auth::user();
        $HasAccess = in_array($user->role , $roles);

        return $next($request); 
    }
}
