<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class TableController extends Controller
{
    public function index(){
    
        $dl= new DataLayer();
        $pairs=$dl->listPairs();
        

    
    return view('tablePage.pairingTable')->with('pairs_list',$pairs);
    }
}
