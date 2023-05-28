<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use GuzzleHttp\Client;

class KrakenController extends Controller
{
    protected $url = 'https://api.kraken.com/0/public/Ticker';

    public function ticker()
    {
        $client=new Client();
        $dl= new DataLayer();

        $response= $client->get($this->url);
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
