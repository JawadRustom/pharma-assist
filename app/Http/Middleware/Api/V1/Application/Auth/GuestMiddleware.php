<?php

namespace App\Http\Middleware\Api\V1\Application\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('api')->check()) {
            return response([
                'message' => 'You are already logged in',
            ], 400);
        }
        return $next($request);
    }
}
