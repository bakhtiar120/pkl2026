<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureOtpVerified
{
   public function handle($request, Closure $next)
{
    if (auth()->check()) {

        if (!auth()->user()->is_2fa_verified &&
            !$request->routeIs('otp.*')) {

            return redirect()->route('otp.form');
        }

    }

    return $next($request);
}
}