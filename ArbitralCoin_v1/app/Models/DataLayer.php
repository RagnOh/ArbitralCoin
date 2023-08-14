<?php

namespace App\Models;

class DataLayer {

    protected $binanceUrl="https://api.binance.com/api/v3/ticker/price";
    protected $krakenUrl="https://api.kraken.com/0/public/Ticker?";
    protected $cryptoUrl="https://api.crypto.com/v2/public/get-ticker";

   

//Funzioni di parsing adattate per ogni exchange
//Exchange Binance
    protected function parseBinance(){

        $data= file_get_contents($this->binanceUrl);
        $tickerData= json_decode($data, true);

        $filteredData=[];

        foreach($tickerData as $pair)
        {
           $filteredData[$pair['symbol']]=$pair['price'];
        }

        
        foreach($filteredData as $pair=>$price){

            $this->addPair("Binance",$pair,$price);
        }

        return response()->json([$filteredData]);
        
    }
//Exchange Kraken
    protected function parseKraken(){

        $data= file_get_contents($this->krakenUrl);
        $tickerData= json_decode($data, true);

        $filteredData=[];

        foreach($tickerData['result'] as $pair=>$data)
        {
           
           $filteredData[$pair]=$data['c'][0];
        }

        
        foreach($filteredData as $pair=>$price){

            $this->addPair("Kraken",$pair,$price);
        }
        
        return response()->json([$filteredData]);   
    }
//Exchange Crypto.com
    protected function parseCryptoCom(){

        $data= file_get_contents($this->cryptoUrl);
        $tickerData= json_decode($data, true);

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

       
        foreach($filteredData as $pair=>$price){

            $this->addPair("Cryptocom",$pair,$price);
        }
       
        return response()->json([$filteredData]);
    }

/////////////////////////////////////////

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
        $user->username = $name;
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
        return $users[0]->username;
    }

    public function isAdmin($username){
        $user= User::where('username',$username)->get();

        if($user[0]->admin==0){
           return false;
        }

        return true;
    }

   /* public function listPairs()
    {
       $pairs = PairTable::select('price')->groupBy('pair')->havingRow('COUNT(DISTINCT exchange)= ?',[count($exchanges)])->get();
       
       return $pairs;
    }*/

    private function addPair($exchangeName,$pair,$price)
    {
      $pairTable=new Pair();
      
        
        $pairTable->exchange =$exchangeName;
        $pairTable->pair = $pair;
        $pairTable->price = $price;
        $pairTable->save();
       
      
    }

    public function updateTable()
    {
        Pair::truncate();
        $this->parseKraken();
        $this->parseBinance();
        $this->parseCryptoCom();
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



public function addUserPreferences($deposito,$valuta,$minGuadagno,$userID)
{
    $userPref= new UserPreferences();
    $userPref->deposito =$deposito;
    $userPref->valuta = $valuta;
    $userPref->guadagno = $minGuadagno;
    $userPref->user_id = $userID;
    $userPref->save();
    
}

public function deleteFavExchanges($id) {
    $favTable = Exchange::where('user_preferences_id',$id);
    $favTable->delete();
}

public function addFavExchanges($binance,$kraken,$crypto,$mockup,$userID)
{

    //Rimuovere da tabella exchange per questo utente
    
    
 
    if($binance)
    {
        $addExchange= new Exchange();
      $addExchange->name="Binance";
      $addExchange->user_preferences_id=$userID;
      $addExchange->save();
    }
    if($kraken)
    {
        $addExchange= new Exchange();
      $addExchange->name="Kraken";
      $addExchange->user_preferences_id=$userID;
      $addExchange->save();
    }
    if($crypto)
    {
        $addExchange= new Exchange();
      $addExchange->name="Crypto";
      $addExchange->user_preferences_id=$userID;
      $addExchange->save();
    }
    if($mockup)
    {
        $addExchange= new Exchange();
      $addExchange->name="Mockup";
      $addExchange->user_preferences_id=$userID;
      $addExchange->save();
    }


}

public function getExchangeList($userId){
 
    $exchange_list=Exchange::where('user_preferences_id',$userId)->pluck('name')->toArray();

    return $exchange_list;

}


public function findUserPreferencesByID($userId)
{
    return UserPreferences::find($userId);
}

public function getBestForEachPair($pairName,$userId)
{
   
   //ottengo il prezzo dello stesso pair su più exchange
   $samePair= Pair::where('pair',$pairName)
             ->orderBy('price','desc')
              ->pluck('exchange')
              ->toArray();
   //ordino da prezzo più alto a quello più basso

   $minGuadagno= UserPreferences::where('user_id',$userId)->value('guadagno');
   $deposito= UserPreferences::where('user_id',$userId)->value('deposito');
   $differenza=end($samePair)-reset($samePair);



   if($differenza!=0){
   if($deposito/$differenza<$minGuadagno)
   {
    
    return $samePair;
   }

}
   $vuoto=[];
  return $vuoto;
   

}

private function confrontValue($pair,$exchange_list)
{
    $exchanges=$exchange_list;
    
}



    
}
