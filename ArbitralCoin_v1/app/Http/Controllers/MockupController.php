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
     
      $dl=new DataLayer();

      $dl->addMockup($this->exchangeName,$request->input('pairName'),$request->input('price'));
      
      return Redirect::to(route('adminMockup.index'));

   }

   public function createNewElement()
   {
      return view('admin.addMockup')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);
   }

   public function destroy($pair)
   {

      $dl=new DataLayer();

      $dl->deleteMockupPair($pair,$this->exchangeName);

      

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

   public function confirmDestroyAll()
   {
      return view('admin.deleteMockupPair')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('pair', null);
   }

   public function destroyAll()
   {
      Mockup::truncate();

      return Redirect::to(route('adminMockup.index'));
   }

   

   public function edit($pairName)
   {
        
      return view('admin.addMockup')->with('logged',true)->with('loggedName',$_SESSION["loggedName"])->with('pair',$pairName);

   }

   public function update(Request $request)
   {
      $dl=new DataLayer();
      $dl->updateMockupPrice($request->pairName,$request->input('price'));
      
     

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