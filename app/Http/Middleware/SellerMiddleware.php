<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
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
        // Check if user is authenticated and has 'seller' role
        if (Auth::check() && $request->user()->hasRole('seller')) {
            return $next($request);
        }

        // If not, redirect to the homepage or any other page
        return redirect('/');
    }
}

