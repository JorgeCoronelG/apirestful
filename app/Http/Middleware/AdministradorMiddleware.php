<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdministradorMiddleware
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Middleware
 * Created 20/11/2020
 */
class AdministradorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == User::USUARIO_ADMINISTRADOR) {
            return $next($request);
        }

        throw new AuthorizationException();
    }
}
