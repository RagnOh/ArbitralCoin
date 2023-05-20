<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrakenController;
use App\Http\Controllers\BinanceController;
use App\Http\Controllers\CryptocomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/kraken/ticker', [KrakenController::class,'ticker']);
Route::get('/binance/ticker', [BinanceController::class,'ticker']);
Route::get('/cryptocom/ticker', [CryptocomController::class,'ticker']);
