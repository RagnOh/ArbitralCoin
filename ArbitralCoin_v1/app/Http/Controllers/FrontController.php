<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FrontController extends Controller
{
    public function getHome()
    {
        session_start();

        $language = App::getLocale();
        if (isset($_SESSION['logged'])) {
          return view('mainPage.firstPage')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('mainPage.firstPage')->with('logged', false);
        }
    }
}
