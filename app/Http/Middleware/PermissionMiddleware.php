<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class PermissionMiddleware
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Middleware
 * Created 22/11/2020
 */
class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$roles
     * @return mixed
     * @throws AuthenticationException
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            throw new AuthenticationException();
        }
        if (!is_array($roles)) {
            foreach (Auth::user()->roles as $rol) {
                $rol = Role::find($rol);
                if ($rol->name === $roles) {
                    return $next($request);
                }
            }
        } else {
            foreach ($roles as $role) {
                foreach (Auth::user()->roles as $rol) {
                    $rol = Role::find($rol);
                    if ($rol->name === $role) {
                        return $next($request);
                    }
                }
            }
        }
        throw new AuthorizationException();
    }
}
