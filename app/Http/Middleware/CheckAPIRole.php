<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;


class CheckAPIRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {

        $allowed = false;

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $roles = explode("|", $roles);
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                $allowed = true;
            }
        }

        if (!$allowed) {
            abort(404);
        }


        return $next($request);
    }
}
