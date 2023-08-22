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
        $favourite=new FavPair();

        $userID=$dl->getUserID($_SESSION["loggedEmail"]);

        $favourite->pair=$request->input('insertPair');
        $favourite->user_preferences_id=$userID;

        $favourite->save();     

        return Redirect::to(route('favPairs.index'));
        
    }

    public function destroy($pairName)
    {
     
        
        $pairElement=FavPair::where('pair',$pairName);
        $pairElement->delete();

        return Redirect::to(route('favPairs.index'));
    }

    public function confirmDestroy($pairName)
   {
       $dl = new DataLayer();
       $pair = $dl->findFavPair($pairName);
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
       $exchanges=$dl->getExchangeList($userID);

       $commonPairs=$dl->getFavPairs($userID)->getOriginalContent();


      
       

       return $dl->pairArrayOptim($commonPairs,$exchanges);
        
    }

    public function favPairCheckForPair(Request $req) {
        $dl = new DataLayer();
        
        if($dl->checkPair($req->input('insertPair')))
        {
            
            if($dl->findFavPair($req->input('insertPair'))){
                $response = array('found'=>false);
            }else {
                $response = array('found'=>true);
            }
        } else {
            $response = array('found'=>false);
        }

          
        
        return response()->json($response);
    }

}
