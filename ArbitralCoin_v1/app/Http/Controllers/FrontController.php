<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome()
    {
        session_start();

        if (isset($_SESSION['logged'])) {
          return view('mainPage.firstPage')->with('logged', false)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('mainPage.firstPage')->with('logged', false);
        }
    }
}
