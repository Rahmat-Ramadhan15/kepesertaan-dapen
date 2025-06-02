<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckPasswordAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->last_password_changed) {
            $expired = Carbon::parse($user->last_password_changed)->addMonths(3);
            if (now()->greaterThanOrEqualTo($expired)) {
                return redirect()->route('password.expired');
            }
        }

        return $next($request);
    }
}
