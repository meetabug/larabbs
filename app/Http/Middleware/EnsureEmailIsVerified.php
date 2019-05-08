<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{

    public function handle($request, Closure $next)
    {
        if ($request->user() &&
            !$request->user()->hasVerifiedEmail() &&
            !$request->is('email/*', 'logout')){
            return $request->expectsJson()
                        ? abort(403,'Your email address is not verified.')
                        : redirect()->route('verification.notice');
        }
            return $next($request);
    }
}