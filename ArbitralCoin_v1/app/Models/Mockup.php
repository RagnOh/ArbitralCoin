<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mockup extends Model
{
    use HasFactory;
    protected $table = 'mockup';
    public $timestamps = false;
    protected $fillable = ['exchange','pair','price'];


   

    
}