<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;

class AdminMiddleware
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
        if (auth()->check() && auth()->user()->hasPermissionTo('dashboard')) {
            return $next($request);
        }
        
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }
}