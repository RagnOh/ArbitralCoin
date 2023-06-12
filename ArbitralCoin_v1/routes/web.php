<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\FavPairsController;
use App\Http\Controllers\BestPairsController;


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

Route::get('/',[FrontController::class,'getHome'])->name('home');
Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login'); //metodo authentication viene chiamato quando creo la form
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/registrationEmailCheck', [AuthController::class, 'registrationCheckForEmail']);

Route::middleware(['authCustom'])->group(function () {

Route::get('/privateSection',[TableController::class,'index'])->name('privateSection.index');
//Route::get('/preferencesSettings',[PreferencesController::class,'index'])->name('userPreferences.index');
Route::resource('preferenceSettings',PreferencesController::class);
Route::post('/preferenceSettings',[PreferencesController::class,'storeSettings'])->name('preferenceSettings.storeSettings');
Route::get('/bestPairs',[BestPairsController::class,'index'])->name('bestPairs.index');
Route::get('/favPairs',[FavPairsController::class,'index'])->name('favPairs.index');
Route::get('/ajaxUpdateTable',[TableController::class,'ajaxUpdate']);
Route::get('/ajaxStoreSettings',[TableController::class,'storeSettings']);
Route::get('/ajaxUpdateBestPairs',[BestPairsController::class,'ajaxGetBest']);

});

