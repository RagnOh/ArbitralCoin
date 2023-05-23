<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class FavPairsController extends Controller
{
    public function index()
    {
    $dl=new DataLayer();
    $userID=$dl->getUserID($_SESSION["loggedEmail"]);

        return view('tablePage.favPairs')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);

    }

}
