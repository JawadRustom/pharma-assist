<?php

namespace App\Http\Middleware\Api\V1;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if($role == 'admin' && auth()->user()->roles->name != 'admin'){
            return response(['message' => 'unauthorized'], 401);
        }
        if($role == 'moderator' && auth()->user()->roles->name != 'moderator'){
            return response(['message' => 'unauthorized'], 401);
        }
        if($role == 'user' && auth()->user()->roles->name != 'user'){
            return response(['message' => 'unauthorized'], 401);
        }
        return $next($request);
    }
}
