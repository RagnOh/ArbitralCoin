<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pairs_commissions extends Model
{
    use HasFactory;

    protected $table = "pairs_commissions";
   public $timestamps = false;
  

   protected $fillable = ['exchange_name','token','minimum','cost'];
}
