<?php

namespace App\Http\Middleware\MyMiddleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class Inactivity
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
        // if(Session::get('last_activity_time') < time()){
        //     Session::flush();
        //     $response = [
        //         'title' => "Please login again.",
        //         'message' => "You have been logged out due to inactivity!.",
        //         'icon' => 'warning',
        //         'status' => 400
        //     ];
        //     $response = json_encode($response, true);
        //     return redirect(route('LoginIndex'))
        //         ->with('status',$response);
        // }
        // Session(['last_activity_time' => time()+60*5]);
        return $next($request);
    }
}
