<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasApiTokens,HasFactory;
    use HasFactory;
    protected $table = 'client';
    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'contact_number',
        'email_address',
        'password'
    ];
    protected $hidden = [
        'password'
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    
}
