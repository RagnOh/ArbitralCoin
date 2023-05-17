<?php

namespace App\Models;

class DataLayer {

    //private $binanceUrl="https://api.binance.com/api/v3/ticker/price'";
    //protected $krakenUrl="https://api.kraken.com/0/public/Ticker?";
    //protected $cryptodotcomUrl="";

   
    
    public function listPairs()
    {
        $binanceUrl="https://api.binance.com/api/v3/ticker/price";
        $krakenUrl="https://api.kraken.com/0/public/Ticker?";
        $cryptoUrl="https://api.crypto.com/v2/public/get-ticker";
        $dataB= file_get_contents($binanceUrl);
        $dataK= file_get_contents($krakenUrl);
        $dataC= file_get_contents($cryptoUrl);
        $listPairsB = json_decode($dataB,true);
        $listPairsK = json_decode($dataK,true);
        $listPairsC = json_decode($dataC,true);

        $listPairs=[];

        foreach($listPairsB as $itemB){
            $partialList=[];
            $symbolB = $itemB['symbol'];
            $price2=$itemB['price'];
            $i=0;
            foreach($listPairsK['result'] as $pair=>$pairData){

                $price1=$pairData['c'][0];
                
                if($pair==$symbolB){
                   // echo $pair.'i';
                    //echo $symbolB.'k';
                    array_push($partialList,$symbolB,$price1);
                    array_push($partialList,$price2);
                    $i=1;
                }


            }
            if($i==1){
                array_push($listPairs,$partialList);
                $i=0;
            }
            
        }

        $listPairs2=[];
foreach($listPairsC['result']['data'] as $data=>$dataSet){
    $supportList=[];
    $t=0;
    foreach($listPairs as $pairing)
    {
        $ph=str_replace(array('_','-'),'',$dataSet['i']);
       

        //print_r($ph);
        if($pairing[0]==$ph)
        {
            array_push($supportList,$pairing[0],$pairing[1]);
            array_push($supportList,$pairing[2],$dataSet['a']);
            $t=1;
        }

    }

    if($t==1)
    {
        array_push($listPairs2,$supportList);

    }

}


        return $listPairs2;

        

        //simbol e price
    }

//Funzioni di parsing adattate per ogni exchange
//Exchange Binance
    public function parseBinance($listPairs){

        $parsingList=[];
        foreach($listPairs as $itemB){

            array_push($parsingList,$itemB['symbol'],$itemB['price']);
        }

        return $parsingList;
    }
//Exchange Kraken
    public function parseKraken($listPairs){

        $parsingList=[];

        foreach($listPairs['result'] as $pair=>$pairData){

            array_push($parsingList,$pair,$pairData['c'][0]);
        }

        return $parsingList;    
    }
//Exchange Crypto.com
    public function parseCryptoCom($listPairs){

        $parsingList=[];

        foreach($listPairs['result']['data'] as $data=>$dataSet){
            $ph=str_replace(array('_','-'),'',$dataSet['i']);

            array_push($parsingList,$ph,$dataSet['a']);
        }


        return $parsingList;
    }

}