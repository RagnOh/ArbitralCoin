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

        return view('tablePage.preferencesSettings')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);
    }

    public function storeSettings(Request $request)
    {
        $dl = new DataLayer();
        $userID=$dl->getUserID($_SESSION["loggedEmail"]);
        $dl->addUserPreferences($request->input('depositAmount'),$request->input('favoriteValute'),$request->input('minGain'),$userID);

        return Redirect::to(route('bestPairs.index'));
    }
}
