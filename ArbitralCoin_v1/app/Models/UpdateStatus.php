<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateStatus extends Model
{
   protected $table = "update_Status";
   public $timestamps = false;
   use HasFactory;

   protected $fillable = ['done'];


   
}