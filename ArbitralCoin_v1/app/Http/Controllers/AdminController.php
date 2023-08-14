<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
   

   public function dashboardView(){

   
    return view('admin.dashboard')->with('logged',true)->with('loggedName',$_SESSION["loggedName"]);
   }

   public function updateTable()
   {
      $users=User::get();

      return response()->json($users);
   }
   
   public function deleteUser($userId)
   {
      $csrfToken = bin2hex(random_bytes(32));

// Salva il token nella sessione
$_SESSION['csrf_token'] = $csrfToken;
      $user=User::where('id',$userId);
      $user->delete();
   }

   public function addUser()
   {

   }
}
