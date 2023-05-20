<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class KrakenController extends Controller
{
    public function ticker()
    {
        $client=new Client();

        $response= $client->get('https://api.kraken.com/0/public/Ticker');
        $tickerData= json_decode($response->getBody(), true);

        $filteredData=[];

        foreach($tickerData['result'] as $pair=>$data)
        {
           $filteredData[$pair]=$data['c'][0];
        }

        return response()->json([$filteredData]);
    }
}
