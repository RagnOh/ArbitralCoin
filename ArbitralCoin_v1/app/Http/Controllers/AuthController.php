<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function authentication() {
        return view('auth.auth');

    }

    public function login(Request $req){
        session_start();
        $dl = new DataLayer();
        
        if($dl->validUser($req->input('email'),$req->input('password'))){
            $_SESSION['logged']=true;
            $_SESSION['loggedName']=$dl->getUserName($req->input('email'));
            $_SESSION['email']=$req->input('email');
            return Redirect::to(route('book.index')); //Se utente è valido vado su una rotta
        }
        return view('auth.authErrorPage'); //Altrimenti apro pagina errore
    }

    public function logout(){
        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }
}
