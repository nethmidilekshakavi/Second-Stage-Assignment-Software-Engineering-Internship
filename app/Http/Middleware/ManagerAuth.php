<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if(!session('manager_logged_in')) {
            return redirect('/login');
        }
        return $next($request);
    }
}
