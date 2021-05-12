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
        $userlogin = $request->session()->get('users');

        if ($request->session()->get('users')['login_as'] != '1')
        {
            return Redirect::route('home');
        }
        return $next($request);
    }
}
