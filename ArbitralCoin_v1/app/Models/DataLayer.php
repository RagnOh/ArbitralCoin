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

        //return Redirect::to(route('pair.updateDone'));
    }

    public function getPairs($exchange_list)
    {
        $exchanges = $exchange_list;
/*        $priceData = [];
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
*/

$commonPairs=Pair::whereIn('exchange',$exchanges)
             ->select('pair')
             ->groupBy('pair')
             ->having(Pair::raw('COUNT(DISTINCT exchange)'), '>', 1)
             ->orderBy('pair')
             ->get('pair');

$intersection=Pair::whereIn('pair',$commonPairs)
              ->select('exchange','pair','price')
              ->orderBy('pair')
              ->get();
  
              
        return $this->pairArrayOptim($commonPairs,$exchanges);
    }

    public function pairArrayOptim($commonPairs,$exchanges)
    {
        $formattedArray = [];
        $supportArray=[];
        foreach ($commonPairs as $pair) {

            $currentPair=$pair;
            $krakenPrice= 0;
            $binancePrice= 0;
            $cryptoPrice= 0;
            $mockupPrice=0;

            foreach($exchanges as $exchange){

                if($exchange == 'Kraken'){

                    $krakenPrice=Pair::where('pair',$currentPair['pair'])
                                 ->where('exchange',$exchange)
                                 ->value('price');
                }
                elseif($exchange == 'Binance'){

                    $binancePrice=Pair::where('exchange',$exchange)
                    ->where('pair',$currentPair['pair'])
                    ->value('price');

                }
                elseif($exchange == 'Cryptocom'){

                    $cryptoPrice=Pair::where('exchange',$exchange)
                    ->where('pair',$currentPair['pair'])
                    ->value('price');

                }
                else{
                    $mockupPrice=Pair::where('exchange',$exchange)
                    ->where('pair',$currentPair['pair'])
                    ->value('price');

                }

                
                
            }
            $supportArray= array("pair"=>$currentPair['pair'], "kraken"=>$krakenPrice, "binance"=>$binancePrice, "crypto"=>$cryptoPrice);
                array_push($formattedArray,$supportArray);

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

public function deleteUserPreferences($userID)
{
    $userPref=UserPreferences::where('user_id',$userID);
    $userPref->delete();
}

public function deleteFavExchanges($id) {
    $favTable = Exchange::where('user_preferences_id',$id);
    $favTable->delete();
}

public function addFavExchanges($binance,$kraken,$crypto,$userID)
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
      $addExchange->name="Cryptocom";
      $addExchange->user_preferences_id=$userID;
      $addExchange->save();
    }
    


}

public function getExchangeList($userId){
 
    $exchange_list=Exchange::where('user_preferences_id',$userId)->pluck('name')->toArray();

    return $exchange_list;//response()->json($exchange_list); 

}


public function findUserPreferencesByID($userId)
{
    $occurence=Exchange::where('user_preferences_id',$userId)->get();
    if (count($occurence) == 0) {
        return false;
    } else {
        return true;
    }
    
}



public function getBestForEachPair($pairName,$userId)
{
   
   //ottengo il prezzo dello stesso pair su più exchange
   $samePair= Pair::where('pair',$pairName)
             ->orderBy('price','asc')
              ->get();
              
              
           
              
              
   //ordino da prezzo più alto a quello più basso

   $minGuadagno= UserPreferences::where('user_id',$userId)->value('guadagno');
   $deposito= UserPreferences::where('user_id',$userId)->value('deposito');

   $x=0;
   $primo=0;
   $primoExchage=0;
   $ultimo=0;
   $ultimoExchage=0;
   $orderResult=[];
   foreach($samePair as $pair)
   {
       if($x==0){
        $primo=$pair['price'];
        $primoExchage=$pair['exchange'];
        
       }

       $x=$x+1;
      

       $ultimo=$pair['price'];
       $ultimoExchage=$pair['exchange'];
   }

   
   if($primo != 0){
   $numPurchasedCoins=$deposito/$primo;
   
   
   $guadagno=($numPurchasedCoins*$ultimo)-$deposito;
   if($guadagno<0){
    $guadagno=0;
   }
}
else{$guadagno=0;}

   $orderResult= array("pair"=>$pairName,"primo"=>$primoExchage,"ultimo"=>$ultimoExchage,"guadagno"=>$guadagno);
   
   if($guadagno>$minGuadagno)
   {
    
    


    return $orderResult;
   }


   $vuoto=[];
  return $orderResult;
   

}

private function parseWithFiat($pairList)
{

}

private function confrontValue($pair,$exchange_list)
{
    $exchanges=$exchange_list;
    
}

public function getFavPairs($userId)
{
    $userFavPairs= FavPair::where('user_preferences_id',$userId)->get('pair');
    
    $pairs=Pair::whereIn('pair',$userFavPairs)->get();


    return response()->json($userFavPairs);


}



public function findUser($username)
{
    return User::where('username',$username)->get();
}

public function findMockupPair($pairName)
{
    return Mockup::where('pair',$pairName)->get();
}

public function checkEmail($email) {
    $users = User::where('email',$email)->get();
    if (count($users) == 0) {
        return false;
    } else {
        return true;
    }
}

public function checkUsername($username) {
    $users = User::where('username',$username)->get();
    if (count($users) == 0) {
        return false;
    } else {
        return true;
    }
}

public function checkPair($pair) {
    $occurence = Pair::where('pair',$pair)->get();
    if (count($occurence) == 0) {
        return false;
    } else {
        return true;
    }
}

public function findFavPair($pair)
{
    $occurence = FavPair::where('pair',$pair)->get();
    if (count($occurence) == 0) {
        return false;
    } else {
        return true;
    }
}


    
}
