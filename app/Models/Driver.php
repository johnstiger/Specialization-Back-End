<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Model
{
    use HasApiTokens,HasFactory;
    use HasFactory;
    protected $table = 'driver';
    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'license',
        'salary',
        'contact_number',
        'status'
    ];
    protected $hidden = [
        'password'
    ];
}
