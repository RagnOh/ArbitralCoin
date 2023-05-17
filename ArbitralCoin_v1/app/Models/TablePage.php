<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TablePage extends Model
{
    
    public function findBestArbitrage()
    {
        
        $bestArbitrage=[];
        $dl= new DataLayer();
        $pairsList=$dl->getPairs();

        $diffBtoK=0;
        $diffBtoC=0;
        $diffKtoC=0;


        foreach($pairsList as $pairs)
        {

            //calcolo la differenza di prezzo tra i vari exchanges
            //Se differenza sarà positiva allora sarà più conveniente traferire dal primo al secondo
            $diffBtoK= $pairs[2]-$pairs[1];
            $diffBtoC= $pairs[2]-$pairs[3];
            $diffKtoC= $pairs[1]-$pairs[3];

            //clcolo la differenza
            if($diffBtoK>0)
            {
              
            }else{
                
            }

            if($diffBtoC>0)
            {

            }else{
                
            }

            if($diffKtoC>0)
            {

            }else{
                
            }


        }



    }

}