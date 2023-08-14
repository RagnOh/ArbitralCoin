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

    public function storeFavPair(Request $request)
    {
        $dl=new DataLayer();
        $favourite=new FavPair();

        $userID=$dl->getUserID($_SESSION["loggedEmail"]);

        $favourite->pair=$request->input('insertPair');
        $favourite->user_preferences_id=$userID;

        $favourite->save();     
        
    }

    public function removeFavPair(Request $request)
    {
     
        $pairElement=FavPair::where('pair',$request);
        $pairElement->delete();
        
    }

    public function ajaxGetFavList()
    {

        
    }

}
