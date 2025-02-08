<?php

namespace App\Http\Middleware\site;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = session('user');

        if (!$user || $user->login_type != 2) {
            return redirect('/sign-in')->withErrors(['message' => 'You need to log in as a customer.']);
        }

        return $next($request);
    }
}
