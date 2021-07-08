<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;

class ProfileFill
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
        $user = Sentinel::getuser();
        $userlogin = $request->session()->get('users');
        if($user->welcome_msg == 0 && $userlogin['login_as'] == 1) {
            return Redirect::route('profile')->with('error', 'Please create your profile for further processs');
        }
        return $next($request);
    }
}
