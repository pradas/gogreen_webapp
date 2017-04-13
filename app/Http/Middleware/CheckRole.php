<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        $roles = explode("|", $roles);
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                $allowed = true;
            }
        }

        if (!$allowed) {
            abort(404);
        }

        return $next($request);
    }
}
