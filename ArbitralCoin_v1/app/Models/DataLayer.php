<?php

namespace App\Models;
use Illuminate\Support\Facades\Redirect;

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

        $this->setDone();
        //return Redirect::to(route('pair.updateDone'));
    }

/////////////////////////////////////////

//Metodi User
    public function validUser($username, $password) {
        $users = User::where('email',$username)->get(['password']);
        
        if(count($users) == 0)
        {
            return false;
        }
        
        return (md5($password) == ($users[0]->password));
    }

    public function findUser($username)
{
    return User::where('username',$username)->get();
}

    public function addUser($name, $password, $email) {
        $user = new User();
        $user->username = $name;
        $user->password = md5($password);
        $user->email = $email;
        $user->pagante = false;
        $user->giorno_pagato=date('y-m-d');
        $user->save();
    }
    
    public function getUserID($username) {
        $users = User::where('email',$username)->get(['id']);
        return $users[0]->id;
    }

    public function getIdByName($username)
    {
        $users = User::where('username',$username)->get(['id']);
        return $users[0]->id; 
    }

    public function getUserName($email) {
        $users = User::where('email',$email)->get();
        return $users[0]->username;
    }

    public function deleteUser($userName){
        $user=User::where('userName',$userName);
        $user->delete();
    }

    public function isAdmin($username){
        $user= User::where('username',$username)->get();

        if($user[0]->admin==0){
           return false;
        }

        return true;
    }

    public function updatePagamento($userName)
    {

            $user=User::where('username',$userName);
            $user->update(['pagante'=> 1]);
            $user->update(['giorno_pagato'=>date('y-m-d')]);
    }

/////////////////////////////////////////
  
//Metodi tabella ausiliaria
    public function updateTableStatus()
    {
        $status=UpdateStatus::where('id',1)->get();
        $risposta=0;
        foreach($status as $element){
            if($element['done'] == 0){
                $risposta=1;
               }
        }
        
        UpdateStatus::truncate();
        
        $tableStatus=new UpdateStatus();
        $tableStatus->done = $risposta;

        $tableStatus->save();

    }

    public function setDone()
    {
        UpdateStatus::truncate();
        $tableStatus=new UpdateStatus();
        $tableStatus->done = 1;

        $tableStatus->save();
    }

    public function resetDone()
    {
        UpdateStatus::truncate();
        $tableStatus=new UpdateStatus();
        $tableStatus->done = 0;

        $tableStatus->save();
    }
    
////////////////////////////////////////

//Metodi PairList

    public function getCommonsPairs($exchange_list)
    {
        $commonPairs=Pair::whereIn('exchange',$exchange_list)
             ->select('pair')
             ->groupBy('pair')
             ->havingRaw('COUNT(DISTINCT exchange) = ?', [count($exchange_list)])
             ->orderBy('pair')
             ->pluck('pair')
             ->toArray();

             return $commonPairs;
    }

    public function getPairs($exchange_list)
    {
        $exchanges = $exchange_list;



$commonPairs=Pair::whereIn('exchange',$exchanges)
             ->select('pair')
             ->groupBy('pair')
             ->havingRaw('COUNT(DISTINCT exchange) = ?', [count($exchanges)])
             ->orderBy('pair')
             ->get('pair');


                          
  
              
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

                }
                    

                

                
                
            }
            $mockupPrice=Mockup::where('pair',$currentPair['pair'])
                    ->value('price');

            $supportArray= array("pair"=>$currentPair['pair'], "kraken"=>$krakenPrice, "binance"=>$binancePrice, "crypto"=>$cryptoPrice , "mockup"=>$mockupPrice);
                array_push($formattedArray,$supportArray);

          }

return response()->json($formattedArray);
    }


////////////////////////////////////////

//Metodi Preferenze Utente
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

public function getMinGuadagno($userId){

    $minGuadagno= UserPreferences::where('user_id',$userId)->value('guadagno');

    return $minGuadagno;
}

public function getDeposito($userId){

    $deposito= UserPreferences::where('user_id',$userId)->value('deposito');
    return $deposito;
}

////////////////////////////////////////

//Metodi Exchange preferiti
public function deleteFavExchanges($id) {
    $favTable = Exchange::where('user_id',$id);
    $favTable->delete();
}



public function addFavExchanges($binance,$kraken,$crypto,$userID)
{

    
    if($binance)
    {
        $addExchange= new Exchange();
      $addExchange->name="Binance";
      $addExchange->user_id=$userID;
      $addExchange->save();
    }
    if($kraken)
    {
        $addExchange= new Exchange();
      $addExchange->name="Kraken";
      $addExchange->user_id=$userID;
      $addExchange->save();
    }
    if($crypto)
    {
        $addExchange= new Exchange();
      $addExchange->name="Cryptocom";
      $addExchange->user_id=$userID;
      $addExchange->save();
    }
    
  


}

public function getExchangeList($userId){
 
    $exchange_list=Exchange::where('user_id',$userId)->pluck('name')->toArray();

    return $exchange_list;//response()->json($exchange_list); 

}


public function findUserPreferencesByID($userId)
{
    $occurence=Exchange::where('user_id',$userId)->get();
    if (count($occurence) == 0) {
        return false;
    } else {
        return true;
    }
    
}

////////////////////////////////////////

//Metodi tabella BestPairs

public function getBestForEachPair($pairName,$userId)
{
   
    $exchange=$this->getExchangeList($userId);
    
    $mockupPrice=Mockup::where('pair',$pairName)->get();

   //ottengo il prezzo dello stesso pair su più exchange
   $samePair= Pair::whereIn('exchange',$exchange)
             ->where('pair',$pairName)
             ->orderBy('price','asc')
              ->get();
   
   //unisco a tabella mockup
   $union= $mockupPrice->concat($samePair);
   $pairResults = $union->sortBy('price');
          
              
   //ordino da prezzo più alto a quello più basso

   $minGuadagno= UserPreferences::where('user_id',$userId)->value('guadagno');
   $deposito= UserPreferences::where('user_id',$userId)->value('deposito');

   $x=0;
   $primo=0;
   $primoExchage=0;
   $ultimo=0;
   $ultimoExchage=0;
   $orderResult=[];
   foreach($pairResults as $pair)
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
   if($guadagno<0 || $guadagno<$minGuadagno){
    $guadagno=0;
   }
}
else{$guadagno=0;}

   $orderResult= array("pair"=>$pairName,"primo"=>$primoExchage,"ultimo"=>$ultimoExchage,"guadagno"=>$guadagno);
   
   if($guadagno>=$minGuadagno)
   {
    
    


    return $orderResult;
   }


   $vuoto=[];
  return $orderResult;
   

}

public function parseWithFiat($pairList,$userID)
{
    
    $valuta= UserPreferences::where('user_id',$userID)->value('valuta');

    
    $valuePairs=[];

    foreach($pairList as $pair)
    {

        if($valuta=="USDT"){
            if(substr($pair['pair'],-4)==$valuta)
            {
                array_push($valuePairs,$pair['pair']);
            }
            
        }else
        {
            if(substr($pair['pair'],-3)==$valuta)
            {
               array_push($valuePairs,$pair['pair']);
            }
        }
      
    }
     
    return $valuePairs;
}

private function confrontValue($pair,$exchange_list)
{
    $exchanges=$exchange_list;
    
}

///////////////////////////////////////

//Metodi favTable
public function getFavPairs($userId)
{
    $userFavPairs= FavPair::where('user_id',$userId)->get('pair');
    
    $pairs=Pair::whereIn('pair',$userFavPairs)->get();


    return response()->json($userFavPairs);


}

public function saveFavPair($userId,$pairName){

    $favourite=new FavPair();
    $favourite->pair=strtoupper($pairName);
    $favourite->user_id=$userId;

        $favourite->save();  
}

public function deleteFavPairs($userId)
{
    $favTable = FavPair::where('user_id',$userId);
    $favTable->delete();
}

public function deleteFavouritePair($pairName)
{
    $pairElement=FavPair::where('pair',$pairName);
    $pairElement->delete();
}

public function findFavPair($pair,$userID)
{
    $occurence = FavPair::where('pair',$pair)->where('user_id',$userID)->get();
    if (count($occurence) == 0) {
        return false;
    } else {
        return true;
    }
}

public function findFavouritePair($pair)
{
    $occurence = FavPair::where('pair',$pair)->get();
    if (count($occurence) == 0) {
        return false;
    } else {
        return true;
    }
}

///////////////////////////////////////


//Metodi mockup
public function findMockupPair($pairName)
{
    return Mockup::where('pair',$pairName)->get();
}

public function addMockup($exchange,$pairName,$price){

    $pair=new Mockup();

      $pair->exchange = $exchange;
      $pair->pair = strtoupper($pairName);
      $pair->price = $price;
      $pair->save();
      
}

public function deleteMockupPair($pair,$exchange)
{

    $pair = Mockup::where('pair',$pair)->where('exchange',$exchange);
    $pair->delete();

}

public function updateMockupPrice($pair,$price){
    Mockup::where('pair',$pair)->update(['price' => $price]);
}



///////////////////////////////////////

//Metodi Pagamenti
public function deleteUserNotPaying()
{
    $users=User::where('pagante',0);
    $users->delete();

}

public function editPagamento($username)
{
    User::where('username',$username)->update(['pagante'=>1]);
}

public function checkPagamento($userName)
{
    $occurence = User::where('username',$userName)->where('pagante',1)->get();
    if (count($occurence) == 0) {
        return false;
    } else {
        return true;
    }
}
    
private function calcoloScadenzaAbbo($userName)
{
    $data=User::where('username',$userName)->value('giorno_pagato');
    
    //$data=date('y-m-d');
   
    $currentDate = new \DateTime();
    $paidDate = new \DateTime($data);
    $interval = $currentDate->diff($paidDate);
    $daysDifference = $interval->days;

    
    if($daysDifference>=30)
    {
        $user=User::where('username',$userName);
            $user->update(['pagante'=> 0]);
    }

    //return Redirect::to(route($data));
   
}

public function controlloScadenze()
{
    $user_list=User::all();

    foreach($user_list as $user)
    {
        $this->calcoloScadenzaAbbo($user['username']);
    }
}

///////////////////////////////////////

//Altri metodi controllo Input
public function pairExistent($nome)
{
    $nomi2=Pair::select('pair')->pluck('pair')->toArray();
    
    $nomi = array_values(array_unique($nomi2));
    
   
    $risultato = "";
    if (strlen($nome) > 0) {
        for ($i = 0; $i < count($nomi); $i++) {
            if (strtoupper($nome) == strtoupper(substr($nomi[$i], 0, strlen($nome)))) {
                if ($risultato == "") {
                    $risultato = $nomi[$i];
                }
                else {
                    $risultato .= ", " . $nomi[$i];
                }
            }
        } 
    } 
    if ($risultato == "") {
        return $risultato;
    }
    else {
        return $risultato;
    }


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

public function getTableStatus()
{
    $status=UpdateStatus::select('done')->get();
    return $status;
}
}
