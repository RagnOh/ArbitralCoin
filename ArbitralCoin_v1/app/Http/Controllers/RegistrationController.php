<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class RegistrationController extends Controller
{
    public function userRegistration() {

        
        return view('subscription.userRegistration')->with('logged', false);

    }

    public function registration(Request $req) {
        
        $dl = new DataLayer();
        
        $dl->addUser($req->input('name'), $req->input('password'), $req->input('email'));
       
        return Redirect::to(route('user.login'));
    }

    public function registrationCheckForEmail(Request $req) {
        $dl = new DataLayer();
        
        if($dl->checkEmail($req->input('email')))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }
}
