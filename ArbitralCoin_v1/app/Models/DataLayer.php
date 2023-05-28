<?php

namespace App\Models;

class DataLayer {

    protected $binanceUrl="https://api.binance.com/api/v3/ticker/price";
    protected $krakenUrl="https://api.kraken.com/0/public/Ticker?";
    protected $cryptoUrl="https://api.crypto.com/v2/public/get-ticker";

   
   /* public function getPairs(){

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



    }*/ 

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

   /* public function listPairs()
    {
       $pairs = PairTable::select('price')->groupBy('pair')->havingRow('COUNT(DISTINCT exchange)= ?',[count($exchanges)])->get();
       
       return $pairs;
    }*/

    public function addPair($exchangeName,$pair,$price)
    {
      $pairTable=new Pair();
      
        
        $pairTable->exchange =$exchangeName;
        $pairTable->pair = $pair;
        $pairTable->price = $price;
        $pairTable->save();
       
      
    }

    public function getPairs($exchange_list)
    {
        $exchanges = $exchange_list;
        $priceData = [];
$formattedArray = [];
$commonPairs = Pair::whereIn('exchange', $exchanges)
    ->select('pair')
    ->groupBy('pair')
    ->havingRaw('COUNT(DISTINCT exchange) = ?', [count($exchanges)])
    ->pluck('pair')
    ->toArray();

foreach ($exchanges as $exchange) {
    $prices = Pair::where('exchange', $exchange)
        ->whereIn('pair', $commonPairs)
        ->pluck('price', 'pair')
        ->toArray();

    $priceData[$exchange] = $prices;
}

foreach ($commonPairs as $pair) {
    $formattedRow = [$pair];
    
    foreach ($exchanges as $exchange) {
        $formattedRow[] = $priceData[$exchange][$pair] ?? '-';
    }

    $formattedArray[] = $formattedRow;
}

return response()->json($formattedArray);
        
    }


public function updateKrakenPairs(){
    
}

public function addUserPreferences($deposito,$valuta,$minGuadagno)
{
    $userPref= new UserPreferences();
    $userPref->deposito =$deposito;
    $userPref->valuta = $valuta;
    $userPref->guadagno = $minGuadagno;
    $userPref->save();
    
}

public function findUserPreferencesByID($userId)
{
    return UserPreferences::find($userId);
}

public function getBestPairs($userPref,$pairtable)
{
    $minGuadagno = $userPref->guadagno;
    $deposito = $userPref->deposito;

    $pairList=getPairs($exchanges); //ottengo tutti i pairs





}

private function confrontValue($pair,$exchange_list)
{
    $exchanges=$exchange_list;
    
}



    
}
