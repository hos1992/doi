<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;

use Closure;

class ChangeLocaleMiddleware
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
        if(session('locale')){
            App::setLocale(session('locale'));
        }
        return $next($request);
    }
}
