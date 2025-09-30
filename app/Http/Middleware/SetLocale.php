<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        return $next($request);
        // \Log::info('SetLocale middleware running...', [
        //     'session_locale' => session('locale'),
        // ]);

        // if (session()->has('locale')) {
        //     app()->setLocale(session('locale'));
        // }

        // return $next($request);
    }
}
