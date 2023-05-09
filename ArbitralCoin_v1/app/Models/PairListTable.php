<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairListTable extends Model
{
   
    protected $dataA;
    protected $dataB;
    protected $dataC;

    protected $jsonA;
    protected $jsonB;
    protected $jsonC;

    function __construct($a,$b,$c)
    {
        $dataA=file_get_contents($a);
        $dataB=file_get_contents($b);
        $dataC=file_get_contents($c);
    }

    public function getJsonData()
    {
        $jsonA=json_decode($dataA);
        $jsonB=json_decode($dataB);
        $jsonC=json_decode($dataC);

        
    }


}