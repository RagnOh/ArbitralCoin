<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavPair extends Model
{
   protected $table = "fav_pairs";
   public $timestamps = false;
   use HasFactory;

   protected $fillable = ['pair','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
