<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table ="exchanges";
    public $timestamps=false;
    use HasFactory;

    protected $fillable = ['name','user_pref_id'];


    public function userPreferences()
    {
        return $this->belongsTo(UserPreferences::class);
    }
}
