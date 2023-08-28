<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class RegistrationController extends Controller
{
    public function userRegistration() {

        
        return view('subscription.userRegistration')->with('admin', false);//->with('pagato',false);

    }

    public function registration(Request $req) {
        
        session_start();
        $dl = new DataLayer();
        
        $userName= $req->input('name');
        $dl->addUser($req->input('name'), $req->input('password'), $req->input('email'));

       
        session(['username'=>$userName]);
        return Redirect::to(route('processTransaction'));
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

    public function registrationCheckForUsername(Request $req) {
        $dl = new DataLayer();
        
        if($dl->checkUsername($req->input('email')))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }

    public function adminSubAssistance()
    {
        return view('subscription.userRegistration')->with('admin', true);//->with('pagato',false);
    }

    public function adminAddUser(Request $req)
    {
         $dl = new DataLayer();
        
        
        $dl->addUser($req->input('name'), $req->input('password'), $req->input('email'));
        $dl->editPagamento($req->input('name'));
        return Redirect::to(route('adminUserList.index'));
    }
}
