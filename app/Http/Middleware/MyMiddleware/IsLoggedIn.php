<?php

namespace App\Http\Middleware\MyMiddleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class IsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('UserID') && Session::has('UserType') && Session::has('UserPassword')){
            return redirect(route(Session::get('UserType')));
        }
        return $next($request);
    }
}
