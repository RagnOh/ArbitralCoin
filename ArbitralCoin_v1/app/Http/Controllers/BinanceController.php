<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BinanceController extends Controller
{
    public function ticker()
    {
        $client=new Client();

        $response= $client->get('https://api.binance.com/api/v3/ticker/price');
        $tickerData= json_decode($response->getBody(), true);

        $filteredData=[];

        foreach($tickerData as $pair)
        {
           $filteredData[$pair['symbol']]=$pair['price'];
        }

        return response()->json([$filteredData]);
    }
}
