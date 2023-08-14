<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Pair;

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
        $exchanges=$dl->getExchangeList($userID);
        $response=$dl->getPairs($exchanges);
        $list=$response->getOriginalContent();

        $migliori=[];
        $miglioriFormattato=[];
        foreach($list as $element)
        {
            $bestValue=$dl->getBestForEachPair($element[0],$userID);
            array_push($migliori,$element[0]);
            array_push($migliori,reset($bestValue));
            array_push($migliori,end($bestValue));
            
            array_push($miglioriFormattato,$migliori);
        }
        
        return $miglioriFormattato;
    }

}