<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pair;
use Illuminate\Support\Facades\Redirect;

class MockupController extends Controller
{
   protected $exchangeName="Mockup";

   public function mockupView(){

      $pairs_list=Pair::where('exchange',$this->exchangeName)->get();

    return view('admin.mockup')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('pairs_list',$pairs_list);
   }

   public function storeElement(Request $request)
   {
     
      $pair=new Pair();

      $pair->exchange = $this->exchangeName;
      $pair->pair = $request->input('pairName');
      $pair->price = $request->input('price');
      $pair->save();
      
      return Redirect::to(route('administrator.mockupView'));

   }

   public function createNewElement()
   {
      return view('admin.addMockup')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);
   }

   public function removeMockupElement($pair)
   {

      $pair = Pair::where('pair',$pair)->where('exchange',$this->exchangeName);
      $pair->delete();

      return Redirect::to(route('administrator.mockupView'));

   }

   

   public function modifyPairPrice($pairName)
   {
        

   }

   public function updatePrice(Request $request,$pairName)
   {
      $pair=Pair::where('pair',$pairName);

      //$pair->price= ;
      //$pair->save();
   }



   
}