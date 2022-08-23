<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function userPreferenceConnectB(){
        return $this->belongsToMany(User::class, 'user_preferences', 'user', 'preference');
    }
}
