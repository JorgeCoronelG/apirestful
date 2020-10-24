<?php

namespace App\Http\Middleware;

use App\Http\Util\Messages;
use App\Traits\ApiResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use ApiResponse;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            return $this->errorResponse(Messages::AUTHENTICATION_EXCEPTION, 401);
        }
    }
}
