<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreferences extends Model
{
    protected $table = "user_preferences_table";
    protected $timestamp = false;
    use HasFactory;

    protected $fillable =['deposito','valuta','guadagno'];
}
