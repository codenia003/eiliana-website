<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;

class SentinelUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $urlPrevious = url()->current();
        $urlBase = url()->to('/');

        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if(($urlPrevious != $urlBase . '/account/login') && ($urlPrevious != $urlBase . '/logout') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url.intended', $urlPrevious);
        }

        // print_r(session()->get('url.intended'));

        if (!Sentinel::check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return Redirect::route('login');
            }
        } else {
            $user = Sentinel::getuser();
            if($user->first_time == 0) {
                Sentinel::logout();
                return Redirect::route('login');
            } else {
                $userlogin = $request->session()->get('users');
                if(empty($userlogin['login_as'])){
                    return Redirect::route('loginas');
                }

            }
        }
        return $next($request);
    }
}
