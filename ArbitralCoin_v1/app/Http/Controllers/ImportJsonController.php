<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UtilityLayer;
use Illuminate\Support\Facades\Storage;

class ImportJsonController extends Controller
{
    public function importData()
    {
        $ul=new UtilityLayer();

        //$ul->addKrakenFees();
        $ul->addBinanceFees();
        $ul->addCryptoComFees();


    }
}
