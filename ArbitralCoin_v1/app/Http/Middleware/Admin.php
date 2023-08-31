<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       $admin=true;
        if($_SESSION['admin'] == 1){
            return $next($request);

        }

        return Redirect::to(route('admin.loginError'));
    }

}
