<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SudoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redirect_url = '/';

        if (!Auth::guest()) {
            $user = auth()->user();

            if ($user->hasRole(['sudo'])) {
                return $next($request);
            } else {
                return redirect($redirect_url);
            }
        }

        return redirect()->guest($redirect_url);
    }
}
