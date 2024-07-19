<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrSellerMiddleware
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
        if (Auth::check() && ($request->user()->hasRole('admin') || $request->user()->hasRole('seller'))) {
            return $next($request);
        }

        return redirect('/'); // یا هر آدرسی که مناسب است
    }
}

