<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;

class SentinelCopmany
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
        $user = Sentinel::getUser();

        if (!$user->hasAccess('company'))
        {
            return Redirect::route('home');
        }
        return $next($request);
    }
}
