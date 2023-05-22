<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\DataLayer;

class KrakenController extends Controller
{
    public function ticker()
    {
        $client=new Client();
        $dl= new DataLayer();

        $response= $client->get('https://api.kraken.com/0/public/Ticker');
        $tickerData= json_decode($response->getBody(), true);

        $filteredData=[];

        foreach($tickerData['result'] as $pair=>$data)
        {
           
           $filteredData[$pair]=$data['c'][0];
        }

        $dl=new Datalayer();
        foreach($filteredData as $pair=>$price){

            $dl->addPair("Kraken",$pair,$price);
        }
        
        return response()->json([$filteredData]);
    }
}
