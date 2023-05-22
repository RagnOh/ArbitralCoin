<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class TableController extends Controller
{
    public function index(){
    
        $dl= new DataLayer();
        $pairs=$dl->getPairs();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        $response=$dl->getPairs();
        $pairList=$response->getOriginalContent();
        

    
    return view('tablePage.pairingTable')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('pairs_list',$pairList);
    }
}
