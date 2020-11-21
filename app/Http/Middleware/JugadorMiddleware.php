<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class JugadorMiddleware
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Middleware
 * Created 20/11/2020
 */
class JugadorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == User::USUARIO_JUGADOR) {
            return $next($request);
        }

        throw new AuthorizationException();
    }
}
