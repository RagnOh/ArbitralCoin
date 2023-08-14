<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreferences extends Model
{
    protected $table = "user_preferences";
    public $timestamps = false;
    use HasFactory;

    protected $fillable =['deposito','valuta','guadagno','user_id'];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favPair()
    {
        return $this->hasMany(FavPair::class);
    }
}
