<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ArbitroMiddleware
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Middleware
 * Created 20/11/2020
 */
class ArbitroMiddleware
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
        if (Auth::check() && Auth::user()->role == User::USUARIO_ARBITRO) {
            return $next($request);
        }

        throw new AuthorizationException();
    }
}
