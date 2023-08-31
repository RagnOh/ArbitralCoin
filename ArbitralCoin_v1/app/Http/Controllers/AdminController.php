<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\DataLayer;


class AdminController extends Controller
{
   

   public function index(){

   
    return view('admin.dashboard')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);
   }

   public function updateTable()
   {
      $users=User::get();

      return response()->json($users);
   }
   
   public function destroy($userName)
   {
      $dl=new DataLayer();
      $userID=$dl->getIdByName($userName);
      $dl->deleteUserPreferences($userID);
      $dl->deleteFavExchanges($userID);
      $dl->deleteFavPairs($userID);
      $user=User::where('userName',$userName);
      $user->delete();

      return Redirect::to(route('adminUserList.index'));
   }

   public function confirmDestroy($userName)
   {
       $dl = new DataLayer();
       $user = $dl->findUser($userName);
       if ($user !== null) {
         
           return view('admin.deleteUser')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('user', $userName);
       } else {
           return view('admin.deleteUserErrorPage')->with('logged', true)->with('loggedName', $_SESSION["loggedName"]);
       }
   }

   public function createNewUser()
   {
      return view('admin.addUser')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);
   }

   public function store(Request $request)
   {
      

      return Redirect::to(route('adminUserList.index'));
   }

   public function adminAccessError()
   {
      return view('defaultErrorPage')->with('admin', true);
   }
}
