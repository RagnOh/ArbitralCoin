<?php

namespace App\Models;

class DataLayer {

    protected $binanceUrl="https://api.binance.com/api/v3/ticker/price";
    protected $krakenUrl="https://api.kraken.com/0/public/Ticker?";
    protected $cryptoUrl="https://api.crypto.com/v2/public/get-ticker";

   
    public function getPairs(){

        $binanceList = $this->parseBinance();
        $krakenList = $this->parseKraken();
        $cryptocomList = $this->parseCryptoCom();

        $listPairs2=[];
        foreach ($krakenList as $pairK){

            $partialList = [];
            $match=0;
            foreach ($cryptocomList as $pairC){

                foreach ($binanceList as $pairB){

                    if($pairK[0] == $pairC[0] && $pairC [0] == $pairB[0]){
                      
                        array_push($partialList,$pairB[0],$pairB[1]);
                        array_push($partialList,$pairK[1],$pairC[1]);

                        $match=1;

                    }


                }
            }

            if($match==1){
                array_push($listPairs2,$partialList);
            }
            

        }

        return $listPairs2;



    } 

//Funzioni di parsing adattate per ogni exchange
//Exchange Binance
    protected function parseBinance(){

        $data= file_get_contents($this->binanceUrl);
        $listPairs= json_decode($data,true);
        $parsingList=[];

        foreach($listPairs as $item){
            $preArray=[];
            array_push($preArray, $item['symbol'],$item['price']);
            array_push($parsingList,$preArray);
            
        }

        return $parsingList;
    }
//Exchange Kraken
    protected function parseKraken(){

        $data= file_get_contents($this->krakenUrl);
        $listPairs= json_decode($data,true);
        $parsingList=[];

        foreach($listPairs['result'] as $pair=>$pairData){
            $preArray=[];
            array_push($preArray,$pair,$pairData['c'][0] );
            array_push($parsingList,$preArray);
        }

        return $parsingList;    
    }
//Exchange Crypto.com
    protected function parseCryptoCom(){

        $data= file_get_contents($this->cryptoUrl);
        $listPairs= json_decode($data,true);
        $parsingList=[];

        foreach($listPairs['result']['data'] as $data=>$dataSet){
            $ph=str_replace(array('_','-'),'',$dataSet['i']);
            $preArray=[];
            array_push($preArray,$ph,$dataSet['a'] );

            array_push($parsingList,$preArray);
        }


        return $parsingList;
    }

    public function validUser($username, $password) {
        $users = User::where('email',$username)->get(['password']);
        
        if(count($users) == 0)
        {
            return false;
        }
        
        return (md5($password) == ($users[0]->password));
    }

    public function addUser($name, $password, $email) {
        $user = new User();
        $user->name = $name;
        $user->password = md5($password);
        $user->email = $email;
        $user->save();
    }
    
    public function getUserID($username) {
        $users = User::where('email',$username)->get(['id']);
        return $users[0]->id;
    }

    public function getUserName($email) {
        $users = User::where('email',$email)->get();
        return $users[0]->name;
    }
}