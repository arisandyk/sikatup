<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */

     
     public function handle(Request $request, Closure $next, string $role): Response
     {
         $user = Auth::user();
     
         if (!$user instanceof User || !$user->hasRole($role)) {
             return response()->json(['message' => 'Unauthorized.'], 403);
         }
     
         return $next($request);
     }
     
}
