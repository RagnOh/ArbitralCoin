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
        $bestPairs=$dl->getBestForEachPair("ALGOUSDT",4,5);

        return view('tablePage.bestPairs')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);

    }

    public function ajaxGetBest()
    {
        $dl=new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        $bestPairs=$dl->getBestForEachPair('ALGOUSDT',4,5);

        return $bestPairs;
    }

}