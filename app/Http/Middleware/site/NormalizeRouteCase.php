<?php

namespace App\Http\Middleware\site;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class NormalizeRouteCase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // Check if the path is not lowercase  
        if ($path !== strtolower($path)) {
            // Redirect to the lowercase path
            return redirect(strtolower($path), 301); // Use a 301 permanent redirect
        }
        return $next($request);
    }
}
