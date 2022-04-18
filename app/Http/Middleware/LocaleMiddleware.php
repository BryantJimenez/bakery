<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language=config('app.locale');
        if (Auth::check() && !is_null(Auth::user()->language)) {
            $language=Auth::user()->language->language;
        }
        app()->setLocale($language);
        return $next($request);
    }
}
