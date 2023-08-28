<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\DataLayer;

class authCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     public function isAdmin($username){
        $user= User::where('username',$username)->get();

        if($user[0]->admin==0){
           return false;
        }

        return true;
    }
    
    public function handle(Request $request, Closure $next)
    {
        session_start();
        $dl=new DataLayer();

        if (!isset($_SESSION['logged'])) {
            return Redirect::to(route('user.login'));
        }

        if(!$dl->checkPagamento($_SESSION['loggedName'])){
           
            return Redirect::to(route('user.notPayed'));
        }

        return $next($request);
    }

    
}
