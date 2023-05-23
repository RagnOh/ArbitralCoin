<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class BestPairsController extends Controller
{

    public function index()
    {
    $dl=new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);

        return view('tablePage.bestPairs')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);

    }

}