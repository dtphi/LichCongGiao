<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuthenticated
{
    /**
     * @author : Phi .
     *
     * @var array : name of route will redirect to member when authenticated.
     */
    protected $redirectIfAuthenticateds = ['login'];

    /**
     * redirect to url when login .
     */
    const RedirectTo = '/';

    /**
     * redirect to url when member logout .
     */
    const RedirectLogout = '/';

    /**
     * Admin guard .
     */
    const AdminGuard = 'web';

    /**
     * @author : Phi .
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $routeName = $request->route()->getName();

        if (Auth::guard(self::AdminGuard)->check() && in_array($routeName, $this->redirectIfAuthenticateds)) {
            return redirect(self::RedirectTo);
        }

        return $next($request);
    }
}
