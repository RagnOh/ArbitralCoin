<?php

namespace App\Models;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UtilityLayer {


    public function addKrakenFees(){

        $name="Kraken";
        $jsonContent = Storage::get('output.json');

       
        $dataArray = json_decode($jsonContent, true);

        // Esegui l'elaborazione dei dati, ad esempio, inserisci i dati nel database
        foreach ($dataArray as $item) {
           $this->addFees($name,$item['token'],$item['fee'],$item['minimum']);
        }
    }

    public function addBinanceFees(){
        $name="Binance";
        $jsonContent = Storage::get('outputB.json');

        // Decodifica il JSON in un array associativo
        $dataArray = json_decode($jsonContent, true);

        // Esegui l'elaborazione dei dati, ad esempio, inserisci i dati nel database
        foreach ($dataArray as $item) {
            $primo=$item['minimo'];
            $parti=explode(' ',$primo);
            $minimo=$parti[0];

            $primo=$item['commissione'];
            $parti=explode(' ',$primo);
            $costo=$parti[0];

            $this->addFees($name,$item['nome'],$minimo,$costo);
        }
    }


    public function addCryptoComFees(){

        $name="Cryptocom";
        $jsonContent = Storage::get('outputC.json');

        // Decodifica il JSON in un array associativo
        $dataArray = json_decode($jsonContent, true);

        // Esegui l'elaborazione dei dati, ad esempio, inserisci i dati nel database
        foreach ($dataArray as $item) {
            $primo=$item['minimo'];
            $parti=explode(' ',$primo);
            $minimo=$parti[0];

            $primo=$item['commissione'];
            $parti=explode(' ',$primo);
            $costo=$parti[0];

            $this->addFees($name,$item['nome'],$minimo,$costo);


        }
    }


    private function addFees($exchangeName,$pair,$minimo,$costo)
    {
      $pairTable=new Pairs_commissions();
      
        
        $pairTable->exchange_name =$exchangeName;
        $pairTable->token = $pair;
        $pairTable->minimum = $minimo;
        $pairTable->cost = $costo;
        $pairTable->save();
       
      
    }

    public function dropFiat($pairName,$userId)
    {
       $fiat=UserPreferences::where('user_id',$userId)->value('valuta');
       
       if($fiat=="USDT"){
        $token=substr($pairName, 0, -4);
       }else{
        $token=substr($pairName, 0, -3);
       }
      





      return $token;
    }

}