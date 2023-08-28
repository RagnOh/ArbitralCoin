<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Pair;
use App\Models\UserPreferences;

class BestPairsController extends Controller
{

    public function index()
    {
        $dl=new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        $bestPairs=$dl->getBestForEachPair("ALGOUSDT",4,5);

        $minGuadagno= UserPreferences::where('user_id',$userID)->value('guadagno');
        $deposito= UserPreferences::where('user_id',$userID)->value('deposito');

        return view('tablePage.bestPairs')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('deposito',$deposito)->with('guadagno',$minGuadagno);

    }

    public function ajaxGetBest()
    {
        $dl=new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        $exchanges=$dl->getExchangeList($userID);
        $response=$dl->getPairs($exchanges);
        
        $list=$response->getOriginalContent();
        $fiatResponse=$dl->parseWithFiat($list,$userID);

        $migliori=[];
        $miglioriFormattato=[];
        foreach($fiatResponse as $element)
        {
            $bestValue=$dl->getBestForEachPair($element,$userID);
            
            if($bestValue['guadagno'])
            array_push($miglioriFormattato,$bestValue);
        }

        //ordino in ordine decrescente
        usort($miglioriFormattato, function($a, $b) {
           
            $guadagnoA = $a['guadagno'];
            $guadagnoB = $b['guadagno'];
        
            if ($guadagnoA == $guadagnoB) {
                return 0;
            }
            return ($guadagnoB < $guadagnoA) ? -1 : 1;
        });
        
        return response()->json($miglioriFormattato);
    }

}