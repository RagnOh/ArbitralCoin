<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontController::class,'getHome'])->name('tablePage.index');

Route::get('/privateSection',[TableController::class,'index'])->name('privateSection.index');

Route::get('/loginPage',[SubscriptionController::class,'index'])->name('loginPage.index');
