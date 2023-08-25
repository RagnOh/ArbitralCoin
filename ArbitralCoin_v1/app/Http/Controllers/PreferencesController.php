<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class PreferencesController extends Controller
{
    public function index(){

        $dl=new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        $fiatList=array("EUR","USD","AUD","GBP","USDT");

        return view('tablePage.preferencesSettings')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('fiatList',$fiatList);
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);

        if($dl->findUserPreferencesByID($userID))
        {
            $dl->deleteFavExchanges($userID);
            $dl->deleteUserPreferences($userID);
        } 
       
        
        $binance=isset($request['Binance']) ? $request['Binance'] : false;
        $kraken=isset($request['Kraken']) ? $request['Kraken'] : false;
        $crypto=isset($request['Crypto']) ? $request['Crypto'] : false;
        
        
        $dl->addUserPreferences($request->input('depositAmount'),$request->input('favoriteValute'),$request->input('minGain'),$userID);
        $dl->addFavExchanges($binance,$kraken,$crypto,$userID);
        return Redirect::to(route('bestPairs.index'));
    }
}
