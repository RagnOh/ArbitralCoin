<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairTable extends Model
{
   protected $table = "pair_table";
   public $timestamps = false;
   use HasFactory;

   protected $fillable = ['exchange', 'pair' , 'price'];

   

}
