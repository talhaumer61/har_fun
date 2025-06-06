<?php

namespace App\Http\Middleware\admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('user')) {
            return redirect('/portal/login')->withErrors(['message' => 'You need to log in first.']);
        }

        $user = $request->session()->get('user');

        // Ensure the logged-in user is an admin
        if ($user->login_type != 1) {
            return redirect('/')->withErrors(['message' => 'Unauthorized access.']);
        }

        return $next($request);
    }
}
