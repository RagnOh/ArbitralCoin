<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CryptocomController extends Controller
{
    public function ticker()
    {
        $client=new Client();

        $response= $client->get('https://api.crypto.com/v2/public/get-ticker');
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
       
       

        return response()->json([$filteredData]);
    }
}
