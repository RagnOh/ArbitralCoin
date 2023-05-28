<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use GuzzleHttp\Client;

class CryptocomController extends Controller
{
    protected $url= 'https://api.crypto.com/v2/public/get-ticker';
    
    public function ticker()
    {
        $client=new Client();

        $response= $client->get($this->url);
        $tickerData= json_decode($response->getBody(), true);

        $filteredData=[];

        foreach($tickerData['result']['data'] as $data=>$pair)
        {
            $sub=str_replace(array('_','-'),'',$pair['i']);
            if(!(strpos($sub,'D36500')==true && substr($sub,-3)==='500'))
            {
                if(!(strpos($sub,'PERP')==true && substr($sub,-3)==='ERP'))
                {
                    if(!(strpos($sub,'365LTV')==true && substr($sub,-3)==='LTV'))
                    {
                        $filteredData[$sub]=$pair['a'];
                    }
                    
                }
                
            }
           
        }

        $dl=new Datalayer();
        foreach($filteredData as $pair=>$price){

            $dl->addPair("Cryptocom",$pair,$price);
        }
       
       

        return response()->json([$filteredData]);
    }
}
