<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (! Auth::check()) {
            // If the user is not logged in, redirect to login page
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role->name !== $role) {
            // If the user does not have the specified role, abort with a 403 error
            abort(403);
        }

        return $next($request);
    }
}
