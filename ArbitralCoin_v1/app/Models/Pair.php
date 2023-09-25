<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    protected $table = 'pairs';
    public $timestamps = false;
    protected $fillable = ['exchange','pair','price'];

    


   

    
}