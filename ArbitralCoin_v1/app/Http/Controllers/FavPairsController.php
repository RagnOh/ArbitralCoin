<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\FavPair;

use Illuminate\Support\Facades\Redirect;


class FavPairsController extends Controller
{
    public function index()
    {
    $dl=new DataLayer();
    $userID=$dl->getUserID($_SESSION["loggedEmail"]);

        return view('tablePage.favPairs')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);

    }

    public function store(Request $request)
    {
        $dl=new DataLayer();

        $dl->saveFavPair($dl->getUserID($_SESSION["loggedEmail"]),strtoupper($request->input('insertPair')));
        //$favourite=new FavPair($dl->getUserID($_SESSION["loggedEmail"]),strtoupper($request->input('insertPair')),$userID);

        //$userID=$dl->getUserID($_SESSION["loggedEmail"]);

        //$favourite->pair=strtoupper($request->input('insertPair'));
        //$favourite->user_id=$userID;

        //$favourite->save();     

        return Redirect::to(route('favPairs.index'));
        
    }

    public function destroy($pairName)
    {
        $dl=new DataLayer();

        $dl->deleteFavouritePair($pairName);
        
        

        return Redirect::to(route('favPairs.index'));
    }

    public function confirmDestroy($pairName)
   {
       $dl = new DataLayer();
       $pair = $dl->findFavouritePair($pairName);
       if ($pair !== null) {
           return view('tablePage.deleteFavPair')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('pair', $pairName);
       } else {
           return view('tablePage.deleteFavPairErrorPage')->with('logged', true)->with('loggedName', $_SESSION["loggedName"]);
       }
   }

    public function ajaxGetFavList()
    {

       $dl=new DataLayer();
       $userID=$dl->getUserID($_SESSION["loggedEmail"]);
       $exch=array("Kraken","Binance","Cryptocom");
       //$exchanges=$dl->getExchangeList($userID);

       $commonPairs=$dl->getFavPairs($userID)->getOriginalContent();


      
       

       return $dl->pairArrayOptim($commonPairs,$exch);
        
    }

    public function favPairCheckForPair(Request $req) {
        $dl = new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        
        if($dl->checkPair($req->input('insertPair')))
        {
            
            if($dl->findFavPair($req->input('insertPair'),$userID)){
                $response = array('found'=>false);
            }else {
                $response = array('found'=>true);
            }
        } else {
            $response = array('found'=>false);
        }

          
        
        return response()->json($response);
    }

    public function ajaxInputAssistant(Request $req)
    {

        $dl=new DataLayer();

        return $dl->pairExistent($req->input('nome'));
    }

}
