<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('admin_email')) {
            return redirect('/account/admin');
        }
        return $next($request);
    }
}
