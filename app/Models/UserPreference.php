<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = ['user', 'preference'];

    public function userPreferenceConnectOne(){
        return $this->belongsTo(User::class);
    }

    public function userPreferenceConnectTwo(){
        return $this->belongsTo(Preference::class);
    }
}
