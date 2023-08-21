<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mockup extends Model
{
    protected $table = 'mockup';
    public $timestamps = false;
    protected $fillable = ['exchange','pair','price'];


   

    
}