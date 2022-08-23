<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email_address', 
        'phone_number', 
        'country', 
        'county', 
        'sub_county', 
        'constituency'
    ];

    public function userPreferenceConnectA(){
        return $this->belongsToMany(Preference::class, 'user_preferences', 'user', 'preference');
    }
}
