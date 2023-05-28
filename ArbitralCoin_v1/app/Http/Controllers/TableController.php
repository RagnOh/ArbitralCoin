<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Pair;

class TableController extends Controller
{
    public function index(){
    
        $dl= new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        $exchanges=Pair::select('exchange')->distinct()->pluck('exchange')->toArray();
        $response=$dl->getPairs($exchanges);
        $pairList=$response->getOriginalContent();
        

    
    return view('tablePage.pairingTable')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('pairs_list',$pairList);
    }
}
