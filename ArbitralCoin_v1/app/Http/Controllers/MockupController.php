<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mockup;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class MockupController extends Controller
{
   protected $exchangeName="Mockup";

   public function index(){

      $pairs_list=Mockup::where('exchange',$this->exchangeName)->get();

    return view('admin.mockup')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('pairs_list',$pairs_list);
   }

   public function store(Request $request)
   {
     
      $pair=new Mockup();

      $pair->exchange = $this->exchangeName;
      $pair->pair = $request->input('pairName');
      $pair->price = $request->input('price');
      $pair->save();
      
      return Redirect::to(route('adminMockup.index'));

   }

   public function createNewElement()
   {
      return view('admin.addMockup')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);
   }

   public function destroy($pair)
   {

      $pair = Mockup::where('pair',$pair)->where('exchange',$this->exchangeName);
      $pair->delete();

      return Redirect::to(route('adminMockup.index'));

   }

   public function confirmDestroy($pairName)
   {
       $dl = new DataLayer();
       $pair = $dl->findMockupPair($pairName);
       if ($pair !== null) {
           return view('admin.deleteMockupPair')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('pair', $pairName);
       } else {
           return view('admin.deleteMockupErrorPage')->with('logged', true)->with('loggedName', $_SESSION["loggedName"]);
       }
   }

   

   public function edit($pairName)
   {
        
      return view('admin.addMockup')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('pair',$pairName);

   }

   public function update(Request $request)
   {
      Mockup::where('pair',$request->pairName)->update(['price' => $request->input('price')]);
      //$mockupTable->exchange= $this->exchangeName;
      //$mockupTable->pair = $request->input('pairName');
      //$mockupTable->price = $request->input('price');

      //$mockupTable->save();

      return Redirect::to(route('adminMockup.index'));
   }

  public function adminMockupCheckForPair(Request $req)
  {
   $dl = new DataLayer();
        
   if($dl->checkPair($req->input('pairName')))
   {
       $response = array('found'=>true);
   } else {
       $response = array('found'=>false);
   }
   return response()->json($response);

  }



   
}