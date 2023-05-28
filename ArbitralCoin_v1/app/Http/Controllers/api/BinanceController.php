<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use GuzzleHttp\Client;

class BinanceController extends Controller
{
    protected $url = 'https://api.binance.com/api/v3/ticker/price';
    
    public function ticker()
    {
        $client=new Client();

        $response= $client->get($this->url);
        $tickerData= json_decode($response->getBody(), true);

        $filteredData=[];

        foreach($tickerData as $pair)
        {
           $filteredData[$pair['symbol']]=$pair['price'];
        }

        $dl=new Datalayer();
        foreach($filteredData as $pair=>$price){

            $dl->addPair("Binance",$pair,$price);
        }

        return response()->json([$filteredData]);
    }
}
